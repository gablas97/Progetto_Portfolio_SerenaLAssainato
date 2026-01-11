<x-layout>

    <div class="container py-5">
        <div class="row justify-content-center align-items-center g-4">
            @forelse($insights as $insight)
                <div class="col-12 col-md-4">
                    <a href="{{ route('insight.show', $insight->id) }}" class="text-decoration-none">
                        <div class="project-card">
                            @if($insight->images)
                                <img src="{{ asset('storage/' . $insight->images[0]) }}" class="project-image" alt="{{ $insight->title }}">
                            @elseif ($insight->type === 'news')
                                <img src="{{ asset('images/news.jpg') }}" 
                                    class="project-image" 
                                    alt="News">
                            @elseif ($insight->type === 'insight')
                                <img src="{{ asset('images/insight.jpg') }}" 
                                    class="project-image" 
                                    alt="Insight">
                            @else
                                <img src="{{ asset('images/interview.jpg') }}" 
                                    class="project-image" 
                                    alt="Default">
                            @endif
                            <div class="project-title-overlay">
                                <p class="mb-0 fs-5">{{ $insight->title }}</p>
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
    </div>

</x-layout>