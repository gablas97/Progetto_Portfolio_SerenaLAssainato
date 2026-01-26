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

                <!-- LINGUE -->
                <ul class="nav nav-tabs mb-4" id="langTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#lang-it" type="button">
                            Italiano
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lang-en" type="button">
                            English
                        </button>
                    </li>
                    <li class="nav-item">
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
                                    value="{{ old("title.$lang", $insight->title[$lang]) }}"
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
                                        required>{{ old("description.$lang", $insight->description[$lang]) }}</textarea>
                                @error('description.'.$lang)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- DATA -->
                <div class="mb-3">
                    <label class="form-label">Data *</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $insight->date->format('Y-m-d')) }}" required>
                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- COPERTINA -->
                <div class="mb-3">
                    <label class="form-label">Immagine Copertina</label>
                    @if(!empty($insight->images[0]))
                        <div class="mb-2 text-start position-relative">
                            <img src="{{ asset('storage/' . $insight->images[0]) }}"
                                class="rounded mb-2 t-05"
                                height="100">

                            <div class="form-check text-start">
                                <input class="form-check-input" type="checkbox" name="delete_images[]" value="0" id="delete_img_0">
                                <label class="form-check-label small text-danger" for="delete_img_0">
                                    Elimina copertina
                                </label>
                            </div>
                        </div>
                    @endif

                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror"
                        name="cover_image"
                        accept="image/*">
                    @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- ALTRE IMMAGINI -->
                <div class="mb-3">
                    <label class="form-label">Altre immagini</label>

                    <div class="d-flex flex-wrap gap-3">
                        @foreach(array_slice($insight->images, 1) as $index => $img)
                            <div class="position-relative text-center">
                                <img src="{{ asset('storage/'.$img) }}"
                                    class="rounded mb-2 t-05"
                                    height="100">

                                <div class="form-check text-start">
                                    <input class="form-check-input" type="checkbox"
                                        name="delete_images[]" value="{{ $index + 1 }}"
                                        id="delete_img_{{ $index + 1 }}">
                                    <label class="form-check-label small text-danger"
                                        for="delete_img_{{ $index + 1 }}">
                                        Elimina
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- CARICA NUOVE IMMAGINI -->
                <div class="mb-3">
                    <label class="form-label">Aggiungi nuove immagini</label>
                    <input type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                            name="images[]" multiple accept="image/*">
                    <small class="text-muted">Le nuove immagini verranno aggiunte a quelle esistenti</small>
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- LINK ARTICOLO -->
                <div class="mb-3">
                    <label class="form-label">Link Articolo</label>
                    <input type="url" class="form-control @error('visit_link') is-invalid @enderror" name="visit_link" value="{{ old('visit_link', $insight->visit_link) }}">
                    @error('visit_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- TIPO -->
                <div class="mb-3">
                    <label class="form-label">Tipo *</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="news" {{ old('type',$insight->type)=='news'?'selected':'' }}>News</option>
                        <option value="insight" {{ old('type',$insight->type)=='insight'?'selected':'' }}>Insight</option>
                        <option value="interview" {{ old('type')=='interview'?'selected':'' }}>Interview</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- CATEGORIE -->
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