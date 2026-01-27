<x-layout>
    
    <div class="container py-5">
        <div class="row align-items-center g-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @forelse($projects as $project)
                <div class="col-12 col-md-6 col-lg-4 zoom-in transition-2 d-flex justify-content-center">
                    <a href="{{ route('project.show', $project->id) }}" class="text-decoration-none">
                        <div class="index-card">
                            <img src="{{ asset('storage/' . $project->images[0]) }}" class="index-image" alt="{{ $project->title[app()->getLocale()] }}">
                            <div class="index-title-overlay">
                                <p class="mb-0 fs-5 fw-bold text-uppercase">{{ $project->title[app()->getLocale()] }}</p>
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