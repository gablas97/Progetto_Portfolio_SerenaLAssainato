<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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
            'categories.*' => 'in:landscape,architecture,urban_planning,illustrations',
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
        //
    }

    public function update(Request $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}
