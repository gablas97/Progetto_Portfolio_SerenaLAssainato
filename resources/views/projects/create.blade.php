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

                        <!-- TITOLO -->
                        <div class="mb-3">
                            <label class="form-label">Titolo <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   name="title"
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- SOTTOTITOLO -->
                        <div class="mb-3">
                            <label class="form-label">Sottotitolo</label>
                            <input type="text"
                                   class="form-control @error('subtitle') is-invalid @enderror"
                                   name="subtitle"
                                   value="{{ old('subtitle') }}">
                            @error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- DESCRIZIONE -->
                        <div class="mb-3">
                            <label class="form-label">Descrizione <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      name="description"
                                      rows="5"
                                      required>{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- LOCATION -->
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text"
                                   class="form-control @error('location') is-invalid @enderror"
                                   name="location"
                                   value="{{ old('location') }}">
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- IMMAGINI -->
                        <div class="mb-3">
                            <label class="form-label">Immagini <span class="text-danger">*</span></label>
                            <input type="file"
                                   class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                   name="images[]"
                                   multiple
                                   accept="image/*"
                                   required>
                            @error('images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- ANNO ESECUZIONE -->
                        <div class="mb-3">
                            <label class="form-label">Anno Esecuzione</label>
                            <input type="number"
                                   class="form-control @error('execution_year') is-invalid @enderror"
                                   name="execution_year"
                                   value="{{ old('execution_year') }}"
                                   min="1900"
                                   max="{{ date('Y') }}">
                            @error('execution_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- CATEGORIE -->
                        <div class="mb-4">
                            <label class="form-label">Categorie <span class="text-danger">*</span></label>
                            @php $cats = old('categories', []); @endphp

                            @foreach(['landscape'=>'Landscape','architecture'=>'Architecture','urban_design'=>'Urban Design','illustrations'=>'Illustrations'] as $value => $label)
                                <div class="form-check">
                                    <input class="form-check-input @error('categories') is-invalid @enderror"
                                           type="checkbox"
                                           name="categories[]"
                                           value="{{ $value }}"
                                           id="create_{{ $value }}"
                                           {{ in_array($value, $cats) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="create_{{ $value }}">{{ $label }}</label>
                                </div>
                            @endforeach

                            @error('categories')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- BOTTONI -->
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