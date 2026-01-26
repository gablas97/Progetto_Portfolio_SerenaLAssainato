<x-layout>
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Crea Nuovo Contenuto</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('insight.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- LINGUE -->
                <ul class="nav nav-tabs mb-4" id="langTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#lang-it" type="button">
                            Italiano
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lang-en" type="button">
                            English
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lang-fr" type="button">
                            Français
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    @foreach (['it' => 'Italiano', 'en' => 'English', 'fr' => 'Français'] as $lang => $label)
                        <div class="tab-pane fade {{ $lang === 'it' ? 'show active' : '' }}" id="lang-{{ $lang }}">

                            <!-- TITOLO -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Titolo ({{ strtoupper($lang) }}) <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control @error('title.'.$lang) is-invalid @enderror"
                                    name="title[{{ $lang }}]"
                                    value="{{ old('title.'.$lang) }}"
                                    required>
                                @error('title.'.$lang)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- DESCRIZIONE -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Descrizione ({{ strtoupper($lang) }}) <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description.'.$lang) is-invalid @enderror"
                                        name="description[{{ $lang }}]"
                                        rows="5"
                                        required>{{ old('description.'.$lang) }}</textarea>
                                @error('description.'.$lang)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                        </div>
                    @endforeach

                </div>

                <!-- DATA -->
                <div class="mb-3">
                    <label class="form-label">Data <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- IMMAGINE COPERTINA -->
                <div class="mb-3">
                    <label class="form-label">Immagine Copertina</label>
                    <input type="file"
                        class="form-control @error('cover_image') is-invalid @enderror"
                        name="cover_image"
                        accept="image/*">
                    @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- IMMAGINI -->
                <div class="mb-3">
                    <label class="form-label">Immagini</label>
                    <input type="file"
                            class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                            name="images[]"
                            multiple
                            accept="image/*">
                    @error('images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- LINK ARTICOLO -->
                <div class="mb-3">
                    <label class="form-label">Link Articolo</label>
                    <input type="url" class="form-control @error('visit_link') is-invalid @enderror" name="visit_link" value="{{ old('visit_link') }}">
                    @error('visit_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- TIPO -->
                <div class="mb-3">
                    <label class="form-label">Tipo <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">Seleziona...</option>
                        <option value="news" {{ old('type')=='news'?'selected':'' }}>News</option>
                        <option value="insight" {{ old('type')=='insight'?'selected':'' }}>Insight</option>
                        <option value="interview" {{ old('type')=='interview'?'selected':'' }}>Interview</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- CATEGORIE -->
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