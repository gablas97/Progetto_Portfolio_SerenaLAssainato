<x-layout>

    <div>
        <x-navbar />
    </div>

    <div class="container py-5">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                ← Torna alla Dashboard
            </a>
        </div>

        <!-- Project Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-4">{{ $project->title }}</h1>
                <p class="text-muted">
                    Eseguito il {{ $project->execution_date->format('d/m/Y') }}
                </p>
                
                <!-- Categories -->
                <div class="mb-3">
                    @foreach($project->categories as $category)
                        <span class="badge bg-secondary text-uppercase me-2">
                            {{ str_replace('_', ' ', $category) }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="row mb-5">
            <div class="col-12">
                <h3>Descrizione</h3>
                <p class="lead">{{ $project->description }}</p>
            </div>
        </div>

        <!-- Images Gallery -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="mb-4">Galleria Immagini</h3>
            </div>
            @foreach($project->images as $image)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <img src="{{ asset('storage/' . $image) }}" 
                        class="img-fluid rounded shadow" 
                        alt="{{ $project->title }}"
                        style="width: 100%; height: 300px; object-fit: cover; cursor: pointer;"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal{{ $loop->index }}">
                </div>

                <!-- Modal per immagine ingrandita -->
                <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-body p-0">
                                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                                <img src="{{ asset('storage/' . $image) }}" 
                                    class="img-fluid w-100" 
                                    alt="{{ $project->title }}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Action Buttons -->
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn btn-warning me-2">
                    Modifica Progetto
                </a>
                <form action="#" 
                    method="POST" 
                    class="d-inline"
                    onsubmit="return confirm('Sei sicuro di voler eliminare questo progetto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Elimina Progetto
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-layout>