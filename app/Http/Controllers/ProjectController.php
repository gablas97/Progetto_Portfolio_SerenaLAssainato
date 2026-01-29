<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Insight;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function project_index()
    {
        $projects = Project::latest('execution_year')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        // Validazione
        $validated = $request->validate([
            'title.it' => 'required|string',
            'title.en' => 'required|string|max:255',
            'title.fr' => 'required|string|max:255',

            'subtitle.it' => 'required|string|max:255',
            'subtitle.en' => 'required|string|max:255',
            'subtitle.fr' => 'required|string|max:255',

            'description.it' => 'required|string',
            'description.en' => 'required|string',
            'description.fr' => 'required|string',

            'location.it' => 'required|string|max:255',
            'location.en' => 'required|string|max:255',
            'location.fr' => 'required|string|max:255',
            
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'videos' => 'nullable|array',
            'videos.*' => 'file|mimes:mp4,avi,mov,wmv|max:51200',

            'execution_year' => 'nullable|integer|digits:4|min:1900|max:' . date('Y'),
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:landscape,architecture,urban_design,illustrations',
        ], [
            'title.required' => 'Il titolo è obbligatorio',
            'description.required' => 'La descrizione è obbligatoria',
            'images.required' => 'Devi caricare almeno un\'immagine',
            'images.min' => 'Devi caricare almeno un\'immagine',
            'categories.required' => 'Devi selezionare almeno una categoria',
            'categories.min' => 'Devi selezionare almeno una categoria',
            'videos.*.max' => 'Ogni video non può superare i 50MB',
        ]);

        // Salva le immagini
        $imagePaths = [];

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('projects', 'public');
            $imagePaths[] = $path;
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $imagePaths[] = $path;
            }
        }

        // Salva video
        $videoPaths = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('projects/videos', 'public');
                $videoPaths[] = $path;
            }
        }

        // Crea il progetto
        $project = Project::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'execution_year' => $validated['execution_year'],
            'categories' => $validated['categories'],
            'images' => $imagePaths,
            'videos' => $videoPaths,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Progetto "' . $project->title['it'] . '" creato con successo!');
    }

    public function show(Project $project)
    {
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where(function($q) use ($project) {
                foreach ($project->categories as $category) {
                    $q->orWhereJsonContains('categories', $category);
                }
            })
            ->get()
            ->map(function($p) {
                $p->sort_date = Carbon::createFromFormat('Y-m-d', $p->execution_year . '-01-01');
                return $p;
            });

        $relatedInsights = Insight::where(function($q) use ($project) {
            foreach ($project->categories as $category) {
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

        return view('projects.show', compact('project', 'relatedItems'));
    }


    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title.it' => 'required|string',
            'title.en' => 'required|string|max:255',
            'title.fr' => 'required|string|max:255',

            'subtitle.it' => 'required|string|max:255',
            'subtitle.en' => 'required|string|max:255',
            'subtitle.fr' => 'required|string|max:255',

            'description.it' => 'required|string',
            'description.en' => 'required|string',
            'description.fr' => 'required|string',

            'location.it' => 'required|string|max:255',
            'location.en' => 'required|string|max:255',
            'location.fr' => 'required|string|max:255',

            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer',

            'delete_videos' => 'nullable|array',
            'delete_videos.*' => 'integer',

            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'videos' => 'nullable|array',
            'videos.*' => 'file|mimes:mp4,avi,mov,wmv|max:51200',

            'execution_year' => 'nullable|integer|digits:4',
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:landscape,architecture,urban_design,illustrations',
        ]);

        $imagePaths = $project->images ?? [];

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
            array_unshift($imagePaths, $request->file('cover_image')->store('projects', 'public'));
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('projects', 'public');
            }
        }

        $videoPaths = $project->videos ?? [];

        if (!empty($validated['delete_videos'])) {
            foreach ($validated['delete_videos'] as $index) {
                if (isset($videoPaths[$index])) {
                    Storage::disk('public')->delete($videoPaths[$index]);
                    unset($videoPaths[$index]);
                }
            }
            $videoPaths = array_values($videoPaths);
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoPaths[] = $video->store('projects/videos', 'public');
            }
        }

        $project->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'images' => $imagePaths,
            'videos' => $videoPaths,
            'execution_year' => $validated['execution_year'],
            'categories' => $validated['categories'],
        ]);

        return redirect()->route('project.index')
            ->with('success', 'Progetto "' . $project->title['it'] . '" aggiornato con successo!');
    }

    public function destroy(Project $project)
    {
        // Cancella le immagini dallo storage
        foreach ($project->images as $image) {
            $fullPath = public_path('storage/' . $image);

            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }

        $project->delete();

        return redirect()->route('project.index')
            ->with('success', 'Progetto "' . $project->title['it'] . '" eliminato con successo!');
    }
}