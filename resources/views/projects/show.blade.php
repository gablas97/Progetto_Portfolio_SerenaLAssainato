<x-layout>

<div class="container py-5">

    <!-- TOGGLE DESCRIZIONE -->
    <div class="row justify-content-center">
        <a href="{{ route('project.index') }}" class="col-2 btn btn-outline-dark me-auto mb-3">{{ __('ui.back') }}</a>
        <button class="col-1 btn btn-outline-dark ms-auto mb-3" id="toggleDescBtn">+</button>
    </div>
    <!-- CAROSELLO + INFO -->
    <div class="row my-5 align-items-start" id="projectMainRow">
        <!-- CAROSELLO -->
        <div class="col-md-8 transition-col" id="carouselCol">
            <div id="projectCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($project->images as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image) }}" 
                                class="d-block w-100 rounded shadow" 
                                style="height: 400px; object-fit: cover;"
                                alt="{{ $project->title }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <div class="col-md-4 transition-col" id="infodescCol">
            <!-- INFO PROGETTO -->
            <div id="infoCol">            
                <h1>{{ $project->title }}</h1>
                @if($project->subtitle)
                    <h4 class="text-muted">{{ $project->subtitle }}</h4>
                @endif
                @if($project->execution_year)
                    <p><strong>{{ __('ui.year') }}:</strong> {{ $project->execution_year }}</p>
                @endif
                @if($project->location)
                    <p><strong>{{ __('ui.location') }}:</strong> {{ $project->location }}</p>
                @endif
                @if($project->categories)
                    <p>
                        <strong>{{ __('ui.categories') }}:</strong>
                        @foreach($project->categories as $category)
                            <span class="badge bg-secondary text-uppercase me-1">
                                {{ str_replace('_', ' ', $category) }}
                            </span>
                        @endforeach
                    </p>
                @endif
            </div>

            <!-- DESCRIZIONE (inizialmente nascosta) -->
            <div class="d-none" id="descriptionCol">
                <h1>{{ $project->title }}</h1>
                <h3>{{ __('ui.description') }}</h3>
                <p class="lead">{!! nl2br(e($project->description)) !!}</p>
            </div>
        </div>
        

    </div>

    <!-- BOTTONI MODIFICA/ELIMINA -->
    @auth
    <div class="mb-4">
        <a href="{{ route('project.edit', $project) }}" class="btn btn-warning me-2">Modifica Progetto</a>
        <form action="{{ route('project.destroy', $project) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Sei sicuro di voler eliminare questo progetto?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina Progetto</button>
        </form>
    </div>
    @endauth

    <!-- ARTICOLI CORRELATI -->
    <div class="mb-5">
        <h3>{{ __('ui.related_articles') }}</h3>
        <div class="row">
            @foreach($relatedItems as $item)
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        @if($item->images && count($item->images) > 0)
                            <img src="{{ asset('storage/' . $item->images[0]) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                        @elseif (!$item->images && $item->type === 'news')
                            <img src="{{ asset('images/news.jpg') }}" 
                                class="card-img-top" style="height:200px; object-fit:cover;"
                                alt="News">
                        @elseif (!$item->images && $item->type === 'insight')
                            <img src="{{ asset('images/insight.jpg') }}" 
                                class="card-img-top" style="height:200px; object-fit:cover;" 
                                alt="Insight">
                        @else
                            <img src="{{ asset('images/interview.jpg') }}" 
                                class="card-img-top" style="height:200px; object-fit:cover;" 
                                alt="Default">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            @if(property_exists($item, 'execution_year') && $item->execution_year)
                                <p class="text-muted mb-1">{{ $item->execution_year }}</p>
                            @endif
                            @if(property_exists($item, 'type') && $item->type)
                                <span class="badge bg-info">{{ ucfirst($item->type) }}</span>
                            @endif
                            <a href="{{ property_exists($item, 'execution_year') ? route('project.show', $item) : route('insight.show', $item) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(count($relatedItems) == 0)
                <p class="text-muted">{{ __('ui.no_related_articles') }}</p>
            @endif
        </div>
    </div>
</div>

</x-layout>