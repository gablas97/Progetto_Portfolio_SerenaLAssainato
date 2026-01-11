<x-layout>
    
    <div class="container py-5">
        <div class="row justify-content-center align-items-center g-4">
            @forelse($projects as $project)
                <div class="col-12 col-md-4">
                    <a href="{{ route('project.show', $project->id) }}" class="text-decoration-none">
                        <div class="project-card">
                            <img src="{{ asset('storage/' . $project->images[0]) }}" class="project-image" alt="{{ $project->title }}">
                            <div class="project-title-overlay">
                                <p class="mb-0 fs-5">{{ $project->title }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">{{ __('ui.no_projects') }}</p>
                </div>
            @endforelse
        </div>
    </div>

</x-layout>