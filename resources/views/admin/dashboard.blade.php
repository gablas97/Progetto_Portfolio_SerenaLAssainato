<x-layout>
    
    <div class="container py-5">
        <!-- Header -->
        <div class="row mb-5 justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-4">Area Amministratore</h1>
                <p class="text-muted">Gestisci i tuoi progetti e le tue news</p>
            </div>
        </div>
        
        <!-- Alert di Successo -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Alert di Errore (opzionale) -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Errore! {{ session('error') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Sezione Progetti -->
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>I tuoi progetti</h2>
                <a href="{{ route('project.create') }}" class="btn btn-primary">
                    + Crea nuovo progetto
                </a>
            </div>
            
            <div class="row g-4">
                @forelse($projects as $project)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('project.show', $project->id) }}" class="text-decoration-none">
                        <div class="card h-100 shadow-sm">
                            <div class="overflow-hidden">
                                <img src="{{ asset('storage/' . $project->images[0]) }}" 
                                class="card-img-top t-05" 
                                alt="{{ $project->title['it'] }} COVER"
                                style="height: 200px; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $project->title['it'] }}</h5>
                                @if($project->description)
                                <p class="card-text text-muted">
                                    {{ Str::limit($project->description['it'], 100) }}
                                </p>
                                @endif
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <small class="text-muted">
                                    Caricato il {{ $project->created_at->format('d/m/Y') }}
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
        </section>
    
        <hr class="my-5">
    
        <!-- Sezione News -->
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Le tue news</h2>
                <a href="{{ route('insight.create') }}" class="btn btn-success">
                    + Crea nuova news
                </a>
            </div>
            
            <div class="row g-4">
                @forelse($insights as $insight)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('insight.show', $insight->id) }}" class="text-decoration-none">
                        <div class="card h-100 shadow-sm">
                            @if($insight->images)
                            <img src="{{ asset('storage/' . $insight->images[0]) }}" 
                                class="card-img-top t-05" 
                                alt="{{ $insight->title['it'] }} COVER"
                                style="height: 200px; object-fit: cover;">
                            @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                            style="height: 200px;">
                            <span class="text-white">Nessuna immagine</span>
                            </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $insight->title['it'] }}</h5>
                                @if($insight->description['it'])
                                <p class="card-text text-muted">
                                    {{ Str::limit($insight->description['it'], 100) }}
                                </p>
                                @endif
                                <p class="card-text text-dark">
                                    Tipo: <span class="text-uppercase">{{ $insight->type }}</span>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <small class="text-muted">
                                    Caricato il {{ $insight->created_at->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Non hai ancora creato nessuna news. Creane una ora!
                    </div>
                </div>
                @endforelse
            </div>
        </section>

        <div class="row">
            <div class="col-12 col-md-6 text-center">
                <a href="{{ route('homepage') }}" class="btn btn-dark">Vai alla homepage</a>
            </div>
            <div class="col-12 col-md-6 text-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
        </div>
    </div>

</x-layout>