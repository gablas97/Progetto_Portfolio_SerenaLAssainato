<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InsightController extends Controller
{
    public function insight_index()
    {
        $insights = Insight::latest('date')->get();
        return view('insights.index', compact('insights'));
    }

    public function create()
    {
        return view('insights.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'images' => 'nullable|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:landscape,architecture,urban_design,illustrations',
            'type' => 'required|in:news,insight,interview',
            'visit_link' => 'nullable|url|max:500',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('insights', 'public');
                $imagePaths[] = $path;
            }
        }

        $insight = Insight::create([
            ...$validated,
            'images' => $imagePaths,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', "Contenuto $insight->title creato con successo!", compact('insight'));
    }

    public function show(Insight $insight)
    {
        $relatedProjects = Project::where(function($q) use ($insight) {
            foreach ($insight->categories as $category) {
                $q->orWhereJsonContains('categories', $category);
            }
        })->get();

        $relatedInsights = Insight::where('id', '!=', $insight->id)
            ->where(function($q) use ($insight) {
                foreach ($insight->categories as $category) {
                    $q->orWhereJsonContains('categories', $category);
                }
            })
            ->get();

        $relatedItems = $relatedProjects->concat($relatedInsights)
                            ->sortByDesc('created_at')
                            ->take(6);

        return view('insights.show', compact('insight', 'relatedItems'));
    }

    public function edit(Insight $insight)
    {
        return view('insights.edit', compact('insight'));
    }

    public function update(Request $request, Insight $insight)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:landscape,architecture,urban_design,illustrations',
            'type' => 'required|in:news,insight,interview',
            'visit_link' => 'nullable|url|max:500',
        ]);

        $imagePaths = $insight->images ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('insights', 'public');
                $imagePaths[] = $path;
            }
        }

        $insight->update([
            ...$validated,
            'images' => $imagePaths,
        ]);

        return redirect()->route('insight.index')->with('success', "Contenuto $insight->title aggiornato con successo!");
    }

    public function destroy(Insight $insight)
    {
        foreach ($insight->images ?? [] as $image) {
            $fullPath = public_path('storage/' . $image);
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }

        $insight->delete();
        return redirect()->route('insight.index')->with('success', "Contenuto $insight->title eliminato con successo!");
    }
}
