<x-layout>

    <x-navbar class="position-absolute top-0 start-50 translate-middle-x text-white z-3 w-100" />

    <!-- SFONDO-->
    <section class="hero">
    </section>

    <!-- SEZIONE ULTIMI PROGETTI -->
    <section class="container py-5 my-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3 text-uppercase" style="letter-spacing: 3px;" data-aos="fade-down">{{ __('ui.latest_projects') }}</h2>
                <p class="text-muted" data-aos="fade-down" data-aos-delay="200">{{ __('ui.latest_projects_subtitle') }}</p>
            </div>
        </div>

        <div class="row mb-5 g-4 justify-content-center align-items-center">
            @forelse($latestProjects as $project)
                <div class="col-12 col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100" data-aos-duration="1000">
                    <a href="{{ route('project.show', $project->id) }}" class="text-decoration-none">
                        <div class="project-card-home">
                            <img src="{{ asset('storage/' . $project->images[0]) }}" 
                                class="project-image-home" 
                                alt="{{ $project->title[app()->getLocale()] }}">
                            
                            <div class="project-overlay-home">
                                <h5 class="mb-2">{{ $project->title[app()->getLocale()] }}</h5>
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
                    <p class="text-center text-muted">{{ __('ui.no_projects') }}</p>
                </div>
            @endforelse
        </div>

        @if(count($latestProjects) >= 3)
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('project.index') }}" class="btn-underline">
                        {{ __('ui.view_all_projects') }}
                    </a>
                </div>
            </div>
        @endif
    </section>

    <!-- DIVISORE -->
    <div class="container px-0">
        <hr class="my-5">
    </div>

    <!-- SEZIONE ULTIMI INSIGHTS -->
    <section class="container py-5 my-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="display-5 mb-3 text-uppercase" style="letter-spacing: 3px;" data-aos="fade-down">{{ __('ui.latest_news') }}</h2>
                <p class="text-muted" data-aos="fade-down" data-aos-delay="200">{{ __('ui.latest_news_subtitle') }}</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center align-items-center">
            @forelse($latestInsights as $insight)
                <div class="col-12 col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100" data-aos-duration="1000">
                    <a href="{{ route('insight.show', $insight->id) }}" class="text-decoration-none">
                        <div class="insight-card-home home-animation">
                            @if($insight->images)
                                <img src="{{ asset('storage/' . $insight->images[0]) }}" 
                                    class="insight-image-home" 
                                    alt="{{ $insight->title[app()->getLocale()] }}">
                            @elseif ($insight->type === 'news')
                                <img src="{{ asset('images/news.jpg') }}" 
                                    class="insight-image-home" 
                                    alt="News">
                            @elseif ($insight->type === 'insight')
                                <img src="{{ asset('images/insight.jpg') }}" 
                                    class="insight-image-home" 
                                    alt="Insight">
                            @else
                                <img src="{{ asset('images/interview.jpg') }}" 
                                    class="insight-image-home" 
                                    alt="Interview">
                            @endif
                            <div class="insight-content-home">
                                <small class="text-muted d-block mb-2">
                                    {{ $insight->date->format('d M Y') }}
                                </small>
                                <h5 class="insight-title">{{ $insight->title[app()->getLocale()] }}</h5>
                                <span class="read-more mt-auto">{{ __('ui.read_more') }} →</span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">{{ __('ui.no_news') }}</p>
                </div>
            @endforelse
        </div>

        @if(count($latestInsights) >= 3)
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('insight.index') }}" class="btn-underline">
                        {{ __('ui.view_all_news') }}
                    </a>
                </div>
            </div>
        @endif
    </section>

</x-layout>