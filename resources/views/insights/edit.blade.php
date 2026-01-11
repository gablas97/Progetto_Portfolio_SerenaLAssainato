<x-layout>
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Modifica Contenuto</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('insight.update', $insight) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Titolo *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $insight->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrizione *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description', $insight->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Data *</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $insight->date->format('Y-m-d')) }}" required>
                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Immagini attuali</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($insight->images ?? [] as $img)
                            <img src="{{ asset('storage/'.$img) }}" width="120" class="rounded me-2 mb-2">
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Aggiungi nuove immagini</label>
                    <input type="file" class="form-control @error('images.*') is-invalid @enderror" name="images[]" multiple accept="image/*">
                    @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Articolo</label>
                    <input type="url" class="form-control @error('visit_link') is-invalid @enderror" name="visit_link" value="{{ old('visit_link', $insight->visit_link) }}">
                    @error('visit_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo *</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="news" {{ old('type',$insight->type)=='news'?'selected':'' }}>News</option>
                        <option value="insight" {{ old('type',$insight->type)=='insight'?'selected':'' }}>Insight</option>
                        <option value="interview" {{ old('type')=='interview'?'selected':'' }}>Interview</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Categorie *</label>
                    @php $cats = old('categories', $insight->categories ?? []); @endphp
                    @foreach(['landscape'=>'Landscape','architecture'=>'Architecture','urban_design'=>'Urban Design','illustrations'=>'Illustrations'] as $v => $l)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $v }}" id="e_{{ $v }}" {{ in_array($v,$cats)?'checked':'' }}>
                            <label class="form-check-label" for="e_{{ $v }}">{{ $l }}</label>
                        </div>
                    @endforeach
                    @error('categories')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('insight.index') }}" class="btn btn-secondary">Annulla</a>
                    <button class="btn btn-primary">Aggiorna</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layout>