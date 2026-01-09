<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function project_index()
    {
        $projects = Project::latest()->get();
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB per immagine
            'execution_date' => 'required|date',
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:landscape,architecture,urban_design,illustrations',
        ], [
            'title.required' => 'Il titolo è obbligatorio',
            'description.required' => 'La descrizione è obbligatoria',
            'images.required' => 'Devi caricare almeno un\'immagine',
            'images.min' => 'Devi caricare almeno un\'immagine',
            'execution_date.required' => 'La data di esecuzione è obbligatoria',
            'categories.required' => 'Devi selezionare almeno una categoria',
            'categories.min' => 'Devi selezionare almeno una categoria',
        ]);

        // Salva le immagini
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $imagePaths[] = $path;
            }
        }

        // Crea il progetto
        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'images' => ($imagePaths),
            'execution_date' => $validated['execution_date'],
            'categories' => ($validated['categories']),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', "Progetto $project->title creato con successo!", compact('project'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'execution_year' => 'nullable|integer|digits:4',
            'categories' => 'required|array|min:1',
            'categories.*' => 'in:landscape,architecture,urban_design,illustrations',
        ]);

        // Se vengono caricate nuove immagini, aggiungile alle esistenti
        $imagePaths = $project->images ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $imagePaths[] = $path;
            }
        }

        $project->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'images' => $imagePaths,
            'execution_year' => $validated['execution_year'],
            'categories' => $validated['categories'],
        ]);

        return redirect()->route('project.index')
            ->with('success', "Progetto $project->title aggiornato con successo!");
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
            ->with('success', "Progetto $project->title aggiornato con successo!");
    }
}