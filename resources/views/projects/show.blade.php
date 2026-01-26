<x-layout>

<div class="container py-5">

    <!-- TOGGLE DESCRIZIONE -->
    <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('project.index') }}" class="btn-underline mb-3 me-auto zoom-in delay-800">{{ __('ui.back') }}</a>
            <button class="btn btn-outline-dark ms-auto mb-3 fs-4 py-0 zoom-in delay-800" id="toggleDescBtn">+</button>
    </div>
    <!-- CAROSELLO + INFO -->
    <div class="row align-items-start" id="projectMainRow">
        <!-- CAROSELLO -->
        <div class="col-md-8 transition-col" id="carouselCol">
            <div id="projectCarousel" class="carousel slide zoom-in delay-800 transition-2" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach(array_slice($project->images, 1) as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image) }}" 
                                class="d-block w-100 rounded" 
                                style="height: 500px; object-fit: contain;"
                                alt="{{ $project->title[app()->getLocale()] }}">
                        </div>
                    @endforeach
                </div>
                @if (count($project->images) > 2)    
                    <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                @endif
            </div>
        </div>

        <div class="col-md-4 transition-col pe-lg-0" id="infodescCol">
            <!-- INFO PROGETTO -->
            <div id="infoCol" class="fade-left delay-400 transition-2">            
                <h1>{{ $project->title[app()->getLocale()] }}</h1>
                @if($project->subtitle)
                    <h4 class="text-muted mb-3">{{ $project->subtitle[app()->getLocale()] }}</h4>
                @endif
                @if($project->execution_year)
                    <p><strong>{{ __('ui.year') }}:</strong> {{ $project->execution_year }}</p>
                @endif
                @if($project->location)
                    <p><strong>{{ __('ui.location') }}:</strong> {{ $project->location[app()->getLocale()] }}</p>
                @endif
                @if($project->categories)
                    <p>
                        <strong>{{ __('ui.categories') }}:</strong>
                        @foreach($project->categories as $category)
                            <span class="badge bg-beige text-uppercase me-1">
                                {{ str_replace('_', ' ', $category) }}
                            </span>
                        @endforeach
                    </p>
                @endif
            </div>

            <!-- DESCRIZIONE (inizialmente nascosta) -->
            <div class="d-none pe-lg-0" id="descriptionCol">
                <h1>{{ $project->title[app()->getLocale()] }}</h1>
                {{-- <h3>{{ __('ui.description') }}</h3> --}}
                <p class="fs-6 text-justify">{!! nl2br($project->description[app()->getLocale()]) !!}</p>
            </div>
        </div>
        

    </div>

    <!-- BOTTONI MODIFICA/ELIMINA -->
    @auth
    <div class="my-4">
        <a href="{{ route('project.edit', $project) }}" class="btn btn-warning me-2">Modifica Progetto</a>
        <form action="{{ route('project.destroy', $project) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Sei sicuro di voler eliminare questo progetto?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina Progetto</button>
        </form>
    </div>
    @endauth

    <!-- DIVISORE -->
    <div class="container px-0">
        <hr class="my-5">
    </div>

    <!-- ARTICOLI CORRELATI -->
    <div class="mb-5">
        <h3 class="mb-5">{{ __('ui.related_articles') }}</h3>

        <div class="swiper related-swiper">
            <div class="swiper-wrapper">

                @forelse($relatedItems as $item)
                    <div class="swiper-slide">

                        <a href="{{ $item instanceof \App\Models\Project ? route('project.show', $item->id) : route('insight.show', $item->id) }}"
                        class="text-decoration-none d-block h-100">

                            <div class="insight-card-home h-100 zoom-in transition-2">
                                <div class="insight-card-inner">
                                    <div style="height: 200px;" class="overflow-hidden">
                                        @if($item->images && count($item->images) > 0)
                                            <img src="{{ asset('storage/' . $item->images[0]) }}"
                                            class="insight-image-home"
                                                alt="{{ $item->title[app()->getLocale()] }}">
                                        @elseif (!$item->images && $item->type === 'news')
                                            <img src="{{ asset('images/news.jpg') }}" 
                                                class="insight-image-home"
                                                alt="News">
                                        @elseif (!$item->images && $item->type === 'insight')
                                            <img src="{{ asset('images/insight.jpg') }}" 
                                                class="insight-image-home" 
                                                alt="Insight">
                                        @else
                                            <img src="{{ asset('images/interview.jpg') }}" 
                                                class="insight-image-home"
                                                alt="Interview">
                                        @endif
                                    </div>
                                    <div class="insight-content-home">
                                        <small class="text-muted d-block">
                                            @if($item instanceof \App\Models\Insight && $item->date)
                                                {{ $item->date->format('d M Y') }}
                                            @endif
                                            @if($item instanceof \App\Models\Project && $item->execution_year)
                                                {{ $item->execution_year }}
                                                @endif
                                        </small>
                                        <div class="row my-1">
                                            <div class="col-6">
                                                @if($item instanceof \App\Models\Insight && $item->type)
                                                    <span class="badge bg-beige text-uppercase">{{ __('ui.types.' . $item->type) }}</span>
                                                @else
                                                    <span class="badge bg-beige text-uppercase">{{ __('ui.project') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <h5 class="insight-title">{{ $item->title[app()->getLocale()] }}</h5>
                                        <span class="read-more mt-auto">{{ __('ui.read_more') }} →</span>
                                    </div>
                                </div>
                            </div>

                        </a>

                    </div>
                @empty
                    <p class="text-center text-muted">{{ __('ui.no_related_articles') }}</p>
                @endforelse

            </div>

            <!-- frecce -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</div>

</x-layout>