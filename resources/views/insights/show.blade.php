<x-layout>

<div class="container py-5">

    <!-- BOTTONE INDIETRO -->
    <div class="mb-4">
        <a href="{{ route('insight.index') }}" class="btn btn-outline-dark">{{ __('ui.back') }}</a>
    </div>

    <!-- META INFO -->
    <div class="mb-2">
        <span class="text-muted">
            {{ $insight->date->format('d/m/Y') }}
        </span>
        <span class="badge bg-dark text-uppercase ms-2">
            {{ $insight->type }}
        </span>
    </div>

    <!-- TITOLO -->
    <h1 class="display-5 mb-4">{{ $insight->title }}</h1>

    <!-- IMMAGINI (se presenti) -->
    @if($insight->images && count($insight->images) > 0)
        <div class="row mb-5">
            @foreach($insight->images as $image)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <img src="{{ asset('storage/' . $image) }}"
                         class="img-fluid rounded shadow"
                         style="width:100%; height:260px; object-fit:cover;"
                         alt="{{ $insight->title }}">
                </div>
            @endforeach
        </div>
    @endif

    <!-- DESCRIZIONE -->
    <div class="mb-5">
        <h3>{{ __('ui.description') }}</h3>
        <p class="lead">{!! nl2br(e($insight->description)) !!}</p>
    </div>

    <!-- VISIT LINK -->
    @if($insight->visit_link)
    <div class="text-center my-5">
        <a href="{{ $insight->visit_link }}" target="_blank" class="btn btn-secondary btn-lg">
            {{ __('ui.read_on_site') }}
        </a>
    </div>
    @endif

        <!-- BOTTONI MODIFICA/ELIMINA -->
    @auth
    <div class="mb-4">
        <a href="{{ route('insight.edit', $insight) }}" class="btn btn-warning me-2">Modifica {{ $insight->type }}</a>
        <form action="{{ route('insight.destroy', $insight) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Sei sicuro di voler eliminare questa {{ $insight->type }}?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina {{ $insight->type }}</button>
        </form>
    </div>
    @endauth

    <!-- ARTICOLI CORRELATI -->
    <div class="mb-5">
        <h3 class="mb-4">{{ __('ui.related_articles') }}</h3>
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
                            <a href="{{ property_exists($item, 'type') ? route('insight.show', $item) : route('project.show', $item) }}" class="stretched-link"></a>
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