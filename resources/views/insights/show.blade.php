<x-layout>

<div class="container py-5">

    <!-- BOTTONE INDIETRO -->
    <div class="row justify-content-center fade-down delay-800">
        <div class="col-12 col-lg-8">
            <div class="mb-4">
                <a href="{{ route('insight.index') }}" class="btn-underline">{{ __('ui.back') }}</a>
            </div>
        
            <!-- META INFO -->
            <div class="mb-2">
                <span class="text-muted">
                    {{ $insight->date->format('d/m/Y') }}
                </span>
                <span class="badge bg-beige text-uppercase ms-2">
                    {{ __('ui.types.' . $insight->type) }}
                </span>
            </div>
            <!-- TITOLO -->
            <h1 class="display-5 mb-lg-4 mb-0">{{ $insight->title[app()->getLocale()] }}</h1>
        </div>
    </div>

    <!-- IMMAGINI E VIDEO (se presenti) -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 my-4 my-lg-0">
            @php
                $carouselImages = array_slice($insight->images, 1);

                $carouselVideos = $insight->videos ?? [];

                $totalItems = count($carouselImages) + count($carouselVideos);
            @endphp

            @if($totalItems > 0)
                <div class="mb-lg-5 zoom-in delay-400 transition-15">
                    <div id="insightCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            
                            {{-- IMMAGINI --}}
                            @foreach($carouselImages as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                        class="d-block w-100 rounded" 
                                        style="height: 450px; object-fit: contain;"
                                        alt="{{ $insight->title[app()->getLocale()] }}">
                                </div>
                            @endforeach

                            {{-- VIDEO --}}
                            @foreach($carouselVideos as $video)
                                <div class="carousel-item {{ empty($carouselImages) && $loop->first ? 'active' : '' }}">
                                    <video class="d-block w-100 rounded" 
                                        style="height: 450px; object-fit: contain;" 
                                        controls>
                                        <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                        Il tuo browser non supporta il tag video.
                                    </video>
                                </div>
                            @endforeach

                        </div>

                        {{-- CONTROLLI CAROSELLO (SOLO SE PIU' DI UNA IMMAGINE) --}}
                        @if ($totalItems > 1)
                            <button class="carousel-control-prev d-flex justify-content-start" type="button" data-bs-target="#insightCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next d-flex justify-content-end" type="button" data-bs-target="#insightCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    

    <div class="row justify-content-center">
        <!-- DESCRIZIONE -->
        <div class="mb-5 col-12 col-lg-8">
            {{-- <h3>{{ __('ui.description') }}</h3> --}}
            <p class="fs-6 text-justify">{!! nl2br($insight->description[app()->getLocale()]) !!}</p>
            <!-- VISIT LINK -->
            @if($insight->visit_link)
            <div class="text-center mt-5">
                <a href="{{ $insight->visit_link }}" target="_blank" class="btn-underline">
                    {{ __('ui.read_on_site') }}
                </a>
            </div>
            @endif
        </div>
    </div>
    


        <!-- BOTTONI MODIFICA/ELIMINA -->
    @auth
    <div class="my-4">
        <a href="{{ route('insight.edit', $insight) }}" class="btn btn-warning me-2">Modifica {{ $insight->type }}</a>
        <form action="{{ route('insight.destroy', $insight) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Sei sicuro di voler eliminare questa {{ $insight->type }}?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina {{ $insight->type }}</button>
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

                            <div class="insight-card-home h-100 zoom-in">
                                <div class="insight-card-inner">
                                    <div style="height: 200px;" class="overflow-hidden">
                                        @if($item->images && count($item->images) > 0)
                                            <img src="{{ asset('storage/' . $item->images[0]) }}"
                                            class="insight-image-show"
                                                alt="{{ $item->title[app()->getLocale()] }}">
                                        @elseif (!$item->images && $item->type === 'news')
                                            <img src="{{ asset('images/news.jpg') }}" 
                                                class="insight-image-show"
                                                alt="News">
                                        @elseif (!$item->images && $item->type === 'insight')
                                            <img src="{{ asset('images/insight.jpg') }}" 
                                                class="insight-image-show" 
                                                alt="Insight">
                                        @else
                                            <img src="{{ asset('images/interview.jpg') }}" 
                                                class="insight-image-show"
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('insightCarousel');
    
    if (carousel) {
        carousel.addEventListener('slid.bs.carousel', function (event) {
            const activeSlide = event.relatedTarget;
            const video = activeSlide.querySelector('video');
            
            if (video) {
                video.currentTime = 0;
                video.play();
            }
        });
    }
});
</script>