<x-layout>

    <div class="container-fluid p-0">
        
        <!-- Hero Section con immagine full width -->
        {{-- <section class="about-hero mt-5">
            <img src="https://picsum.photos/1920/600?random=1" alt="About Header" class="w-100" style="height: 75vh; object-fit: cover;">
        </section> --}}

        <!-- Bio Section -->
        <section class="container py-5 mb-5">
            <div class="row d-flex justify-content-center align-items-end">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="{{ asset('images/foto portrait.png') }}" 
                        alt="Serena L'Assainato" 
                        class="img-fluid shadow-lg"
                        style="width: 100%; height: 600px; object-fit: cover;">
                </div>
                <div class="col-lg-6 ps-lg-5 d-flex flex-column justify-content-end h-100">
                    <h2 class="display-5 mb-4 text-uppercase about-me">{{ __('ui.about_me') }}</h2>
                    <div class="mt-auto text-justify">
                        <p class="mb-4">
                            {{ __('ui.about_me_1') }}
                        </p>
                        <p class="mb-4">
                            {{ __('ui.about_me_2') }}
                        </p>
                        <p class="mb-0">
                            {{ __('ui.about_me_3') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Immagine divisoria full width -->
        {{-- <section class="about-divider">
            <img src="{{ asset('images/section.png') }}" alt="Divider" class="w-100" style="height: 50vh; object-fit: cover;">
        </section> --}}

        <!-- Curriculum Section -->
        <section class="container py-5 my-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <h2 class="display-5 text-center">Curriculum</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    
                    <!-- 2025 -->
                    <div class="cv-item row mb-4 pb-2 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-regular">2025</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down">
                            <p class="mb-0">• {!!  __('ui.2025') !!}</p>
                        </div>
                    </div>

                    <!-- 2024 -->
                    <div class="cv-item row mb-4 pb-2 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-regular">2024</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down" style="--i:1">
                            <p class="mb-0">• {!!  __('ui.2024') !!}</p>
                        </div>
                    </div>

                    <!-- 2023 -->
                    <div class="cv-item row mb-4 pb-2 border-bottom">
                        <div class="col-md-2 cv-year mt-auto">
                            <h4 class="fw-regular">2023</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down" style="--i:2">
                            <p class="mb-2">• {!!  __('ui.2023') !!}</p>
                        </div>
                    </div>

                    <!-- 2022 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year mt-auto">
                            <h4 class="fw-regular mb-lg-0">2022</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down" style="--i:3">
                            <p class="mb-2">• {!!  __('ui.2022_1') !!}</p>
                            <p class="mb-0">• {!!  __('ui.2022_2') !!}</p>
                        </div>
                    </div>

                    <!-- 2021 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year mt-auto">
                            <h4 class="fw-regular mb-lg-0">2021</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down" style="--i:4">
                            <p class="mb-2">• {!!  __('ui.2021_1') !!}</p>
                            <p class="mb-0">• {!!  __('ui.2021_2') !!}</p>
                        </div>
                    </div>

                    <!-- 2020 -->
                    <div class="cv-item row mb-4 pb-2 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-regular">2020</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down" style="--i:5">
                            <p class="mb-0">• {!!  __('ui.2020') !!}</p>
                        </div>
                    </div>

                    <!-- 2019 -->
                    <div class="cv-item row mb-4 pb-2 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-regular">2019</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down" style="--i:6">
                            <p class="mb-0">• {!!  __('ui.2019') !!}</p>
                        </div>
                    </div>

                    <!-- 2018 -->
                    <div class="cv-item row mb-4 pb-2 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-regular">2018</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down" style="--i:7">
                            <p class="mb-0">• {!!  __('ui.2018') !!}</p>
                        </div>
                    </div>

                    <!-- 2016 -->
                    <div class="cv-item row mb-4">
                        <div class="col-md-2 cv-year mt-auto">
                            <h4 class="fw-regular mb-lg-0">2016</h4>
                        </div>
                        <div class="col-md-10 cv-description fade-down" style="--i:8">
                            <p class="mb-2">• {!!  __('ui.2016_1') !!}</p>
                            <p class="mb-0">• {!!  __('ui.2016_2') !!}</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Gallery section con 3 immagini affiancate -->
        {{-- <section class="container-fluid px-0 mb-5">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="https://picsum.photos/800/600?random=4" 
                        alt="Work 1" 
                        class="img-fluid w-100" 
                        style="height: 400px; object-fit: cover;">
                </div>
                <div class="col-md-4">
                    <img src="https://picsum.photos/800/600?random=5" 
                        alt="Work 2" 
                        class="img-fluid w-100" 
                        style="height: 400px; object-fit: cover;">
                </div>
                <div class="col-md-4">
                    <img src="https://picsum.photos/800/600?random=6" 
                        alt="Work 3" 
                        class="img-fluid w-100" 
                        style="height: 400px; object-fit: cover;">
                </div>
            </div>
        </section> --}}

    </div>

</x-layout>