<x-layout>

    <x-navbar class="position-absolute top-0 start-50 translate-middle-x text-white z-3 w-100" />

    <!-- SFONDO-->
    <section class="hero">
    </section>

    <!-- SEZIONE ULTIMI PROGETTI -->
    <section class="container py-5 my-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3" style="letter-spacing: 3px;">LATEST WORKS</h2>
                <p class="text-muted">Recent projects in landscape architecture and urban design</p>
            </div>
        </div>

        <div class="row mb-5 g-4">
            @forelse($latestProjects as $project)
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ route('project.show', $project->id) }}" class="text-decoration-none">
                        <div class="project-card-home">
                            <img src="{{ asset('storage/' . $project->images[0]) }}" 
                                class="project-image-home" 
                                alt="{{ $project->title }}">
                            
                            <div class="project-overlay-home">
                                <h5 class="mb-2">{{ $project->title }}</h5>
                                <div class="project-categories">
                                    @foreach($project->categories as $category)
                                        <span class="badge bg-light text-dark me-1">
                                            {{ str_replace('_', ' ', strtoupper($category)) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No projects available yet.</p>
                </div>
            @endforelse
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('project.index') }}" class="btn btn-outline-dark btn-lg px-5">
                    VIEW ALL PROJECTS
                </a>
            </div>
        </div>
    </section>

    <!-- DIVISORE -->
    <div class="container px-0">
        <hr class="my-5">
    </div>

    <!-- SEZIONE ULTIMI INSIGHTS -->
    <section class="container py-5 my-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3" style="letter-spacing: 3px;">NEWS & INSIGHTS</h2>
                <p class="text-muted">Latest updates and thoughts on architecture</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($latestInsights as $insight)
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ route('insight.show', $insight->id) }}" class="text-decoration-none">
                        <div class="insight-card-home">
                            @if($insight->image)
                                <img src="{{ asset('storage/' . $insight->image) }}" 
                                    class="insight-image-home" 
                                    alt="{{ $insight->title }}">
                            @else
                                <div class="insight-image-home bg-secondary d-flex align-items-center justify-content-center">
                                    <span class="text-white">No image</span>
                                </div>
                            @endif
                            
                            <div class="insight-content-home">
                                <small class="text-muted d-block mb-2">
                                    {{ $insight->created_at->format('d M Y') }}
                                </small>
                                <h5 class="insight-title">{{ $insight->title }}</h5>
                                @if($insight->excerpt)
                                    <p class="insight-excerpt text-muted">
                                        {{ Str::limit($insight->excerpt, 80) }}
                                    </p>
                                @endif
                                <span class="read-more">Read more →</span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No insights available yet.</p>
                </div>
            @endforelse
        </div>

        @if(count($latestInsights) >= 4)
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('insight.index') }}" class="btn btn-outline-dark btn-lg px-5">
                        VIEW ALL INSIGHTS
                    </a>
                </div>
            </div>
        @endif
    </section>

</x-layout>