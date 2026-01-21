<x-layout>

    <div class="container py-5">
        <div class="row align-items-center g-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @forelse($insights as $insight)
                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-right" data-aos-duration="1200">
                    <a href="{{ route('insight.show', $insight->id) }}" class="text-decoration-none">
                        <div class="index-card">
                            @if($insight->images)
                                <img src="{{ asset('storage/' . $insight->images[0]) }}" class="index-image" alt="{{ $insight->title[app()->getLocale()] }}">
                            @elseif ($insight->type === 'news')
                                <img src="{{ asset('images/news.jpg') }}" 
                                    class="index-image" 
                                    alt="News">
                            @elseif ($insight->type === 'insight')
                                <img src="{{ asset('images/insight.jpg') }}" 
                                    class="index-image" 
                                    alt="Insight">
                            @else
                                <img src="{{ asset('images/interview.jpg') }}" 
                                    class="index-image" 
                                    alt="Default">
                            @endif
                            <div class="index-title-overlay">
                                <p class="mb-0 fs-5 text-uppercase">{{ $insight->title[app()->getLocale()] }}</p>
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