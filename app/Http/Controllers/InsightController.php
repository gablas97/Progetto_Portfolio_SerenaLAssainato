<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Insight;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            'title.it' => 'required|string',
            'title.en' => 'required|string|max:255',
            'title.fr' => 'required|string|max:255',

            'description.it' => 'required|string',
            'description.en' => 'required|string',
            'description.fr' => 'required|string',

            'date' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images' => 'nullable|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:landscape,architecture,urban_design,illustrations',
            'type' => 'required|in:news,insight,interview',
            'visit_link' => 'nullable|url|max:500',
        ]);

        $imagePaths = [];

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('insights', 'public');
            $imagePaths[] = $path;
        }

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
            ->with('success', 'Contenuto "' . $insight->title['it'] . '" creato con successo!');
    }

    public function show(Insight $insight)
    {
        $relatedProjects = Project::where(function($q) use ($insight) {
            foreach ($insight->categories as $category) {
                $q->orWhereJsonContains('categories', $category);
            }
        })
        ->get()
        ->map(function($p) {
            $p->sort_date = Carbon::createFromFormat('Y-m-d', $p->execution_year . '-01-01');
            return $p;
        });

        $relatedInsights = Insight::where('id', '!=', $insight->id)
            ->where(function($q) use ($insight) {
                foreach ($insight->categories as $category) {
                    $q->orWhereJsonContains('categories', $category);
                }
            })
            ->get()
            ->map(function($i) {
                $i->sort_date = Carbon::parse($i->date);
                return $i;
            });

        $relatedItems = $relatedProjects->concat($relatedInsights)
                            ->sortByDesc('sort_date')
                            ->values();

        return view('insights.show', compact('insight', 'relatedItems'));
    }

    public function edit(Insight $insight)
    {
        return view('insights.edit', compact('insight'));
    }

    public function update(Request $request, Insight $insight)
    {
        $validated = $request->validate([
            'title.it' => 'required|string',
            'title.en' => 'required|string|max:255',
            'title.fr' => 'required|string|max:255',

            'description.it' => 'required|string',
            'description.en' => 'required|string',
            'description.fr' => 'required|string',

            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer',

            'date' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:landscape,architecture,urban_design,illustrations',
            'type' => 'required|in:news,insight,interview',
            'visit_link' => 'nullable|url|max:500',
        ]);

        $imagePaths = $insight->images ?? [];

        if (!empty($validated['delete_images'])) {
            foreach ($validated['delete_images'] as $index) {
                if (isset($imagePaths[$index])) {
                    Storage::disk('public')->delete($imagePaths[$index]);
                    unset($imagePaths[$index]);
                }
            }
            $imagePaths = array_values($imagePaths);
        }

        if ($request->hasFile('cover_image')) {
            array_unshift($imagePaths, $request->file('cover_image')->store('insights', 'public'));
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('insights', 'public');
            }
        }

        $insight->update([
            ...$validated,
            'images' => $imagePaths,
        ]);

        return redirect()->route('insight.index')->with('success', 'Contenuto "' . $insight->title['it'] . '" aggiornato con successo!');
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
        return redirect()->route('insight.index')->with('success', 'Contenuto "' . $insight->title['it'] . '" eliminato con successo!');
    }
}
