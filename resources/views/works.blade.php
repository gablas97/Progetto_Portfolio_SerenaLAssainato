<x-layout>
    
    <div>
        <x-navbar />
    </div>
    
    <div class="container py-5">
        <div class="row mb-5 justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-4">WORKS</h1>
            </div>
        </div>
    
        <div class="row g-4">
            @forelse($works as $work)
            <div class="col-md-6 col-lg-4">
                <a href="#}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm">
                        @if($work->image)
                            <img src="{{ asset('storage/' . $work->image) }}" 
                            class="card-img-top" 
                            alt="{{ $work->title }}"
                            style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                            style="height: 200px;">
                                <span class="text-white">Nessuna immagine</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $work->title }}</h5>
                            @if($work->description)
                            <p class="card-text text-muted">
                                {{ Str::limit($work->description, 100) }}
                            </p>
                            @endif
                            <p class="card-text text-dark">
                                Categoria: {{ $work->category }}
                                Data: {{ ($work->date->format('d/m/Y')) }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <small class="text-muted">
                                Creato il {{ $work->created_at->format('d/m/Y') }}
                            </small>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Non hai ancora creato nessun progetto. Creane uno ora!
                </div>
            </div>
            @endforelse
        </div>
    </div>

</x-layout>