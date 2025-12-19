<x-layout>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Crea Nuovo Progetto</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Titolo -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    id="title" 
                                    name="title" 
                                    value="{{ old('title') }}" 
                                    required
                                >
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Descrizione -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrizione <span class="text-danger">*</span></label>
                                <textarea 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    id="description" 
                                    name="description" 
                                    rows="5" 
                                    required
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Immagini -->
                            <div class="mb-3">
                                <label for="images" class="form-label">Immagini <span class="text-danger">*</span> (minimo 1)</label>
                                <input 
                                    type="file" 
                                    class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" 
                                    id="images" 
                                    name="images[]" 
                                    multiple 
                                    accept="image/*"
                                    required
                                >
                                <small class="text-muted">Puoi selezionare più immagini tenendo premuto Ctrl (o Cmd su Mac)</small>
                                @error('images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('images.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Data Esecuzione -->
                            <div class="mb-3">
                                <label for="execution_date" class="form-label">Data Esecuzione <span class="text-danger">*</span></label>
                                <input 
                                    type="date" 
                                    class="form-control @error('execution_date') is-invalid @enderror" 
                                    id="execution_date" 
                                    name="execution_date" 
                                    value="{{ old('execution_date') }}" 
                                    required
                                >
                                @error('execution_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Categorie -->
                            <div class="mb-4">
                                <label class="form-label">Categorie <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input @error('categories') is-invalid @enderror" 
                                        type="checkbox" 
                                        name="categories[]" 
                                        value="landscape" 
                                        id="landscape"
                                        {{ in_array('landscape', old('categories', [])) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="landscape">
                                        Landscape
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input @error('categories') is-invalid @enderror" 
                                        type="checkbox" 
                                        name="categories[]" 
                                        value="architecture" 
                                        id="architecture"
                                        {{ in_array('architecture', old('categories', [])) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="architecture">
                                        Architecture
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input @error('categories') is-invalid @enderror" 
                                        type="checkbox" 
                                        name="categories[]" 
                                        value="urban_planning" 
                                        id="urban_planning"
                                        {{ in_array('urban_planning', old('categories', [])) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="urban_planning">
                                        Urban Planning
                                    </label>
                                </div>
                                @error('categories')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Annulla</a>
                                <button type="submit" class="btn btn-primary">Crea Progetto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>