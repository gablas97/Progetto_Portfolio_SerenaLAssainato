<x-layout>
    
    <h1 class="text-center my-5">
        AREA AMMINISTRATORE
    </h1>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 border border-2">
                <div class="my-5 px-5">
                    <h3 class="text-center">Login</h3>
                    
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus
                                >
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                required
                                >
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="remember" 
                                name="remember"
                                >
                                <label class="form-check-label" for="remember">
                                    Ricordami
                                </label>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Accedi
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    
</x-layout>