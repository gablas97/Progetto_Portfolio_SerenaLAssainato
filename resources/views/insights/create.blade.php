<x-layout>
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Crea Nuovo Contenuto</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('insight.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Titolo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrizione <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Data <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Immagini</label>
                    <input type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" name="images[]" multiple accept="image/*">
                    @error('images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Articolo</label>
                    <input type="url" class="form-control @error('visit_link') is-invalid @enderror" name="visit_link" value="{{ old('visit_link') }}">
                    @error('visit_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">Seleziona...</option>
                        <option value="news" {{ old('type')=='news'?'selected':'' }}>News</option>
                        <option value="insight" {{ old('type')=='insight'?'selected':'' }}>Insight</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Categorie <span class="text-danger">*</span></label>
                    @php $cats = old('categories', []); @endphp
                    @foreach(['landscape'=>'Landscape','architecture'=>'Architecture','urban_design'=>'Urban Design','illustrations'=>'Illustrations'] as $v => $l)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $v }}" id="c_{{ $v }}" {{ in_array($v,$cats)?'checked':'' }}>
                            <label class="form-check-label" for="c_{{ $v }}">{{ $l }}</label>
                        </div>
                    @endforeach
                    @error('categories')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Annulla</a>
                    <button class="btn btn-primary">Crea</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layout>