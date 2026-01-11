<x-layout>

    <div class="container py-5">

        <!-- SEZIONE INFO CONTATTI -->
        {{-- <section class="row mb-5 pb-5 border-bottom">
            <div class="col-lg-8 offset-lg-2">
                <div class="row text-center">
                    
                    <!-- Email -->
                    <div class="col-md-3 mb-4 mb-md-0">
                        <div class="contact-item">
                            <div class="contact-icon mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                            </div>
                            <h5 class="mb-2">EMAIL</h5>
                            <a href="mailto:prova@gmail.com" class="contact-link">prova@gmail.com</a>
                        </div>
                    </div>

                    <!-- LinkedIn -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="contact-item">
                            <div class="contact-icon mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                    <rect x="2" y="9" width="4" height="12"/>
                                    <circle cx="4" cy="4" r="2"/>
                                </svg>
                            </div>
                            <h5 class="mb-2">LINKEDIN</h5>
                            <a href="https://linkedin.com/in/serena-lassainato" target="_blank" class="contact-link">serena-lassainato@linkedin.com</a>
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div class="col-md-3">
                        <div class="contact-item">
                            <div class="contact-icon mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                                </svg>
                            </div>
                            <h5 class="mb-2">INSTAGRAM</h5>
                            <a href="https://instagram.com/sxl.arch" target="_blank" class="contact-link">@sxl.arch</a>
                        </div>
                    </div>

                </div>
            </div>
        </section> --}}

        <!-- SEZIONE CONTATTAMI -->
        <section class="row">
            <div class="col-lg-8 offset-lg-2">
                
                <div class="text-center mb-5">
                    <h2 class="display-6 mb-3">{{ __('ui.get_in_touch') }}</h2>
                    <p class="text-muted">{{ __('ui.contact_subtitle') }}</p>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Successo!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Contact Form -->
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf

                            <!-- Nome e Cognome -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <label for="first_name" class="form-label">{{ __('ui.first_name')}} <span class="text-danger">*</span></label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('first_name') is-invalid @enderror" 
                                        id="first_name" 
                                        name="first_name" 
                                        value="{{ old('first_name') }}" 
                                        required
                                    >
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">{{ __('ui.last_name') }} <span class="text-danger">*</span></label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('last_name') is-invalid @enderror" 
                                        id="last_name" 
                                        name="last_name" 
                                        value="{{ old('last_name') }}" 
                                        required
                                    >
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div class="mb-4">
                                <label for="message" class="form-label">{{ __('ui.message') }} <span class="text-danger">*</span></label>
                                <textarea 
                                    class="form-control @error('message') is-invalid @enderror" 
                                    id="message" 
                                    name="message" 
                                    rows="6" 
                                    required
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark btn-lg px-5 py-3 text-uppercase">
                                    {{ __('ui.send_message') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </section>

    </div>

</x-layout>