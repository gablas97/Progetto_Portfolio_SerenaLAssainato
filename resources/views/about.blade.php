<x-layout>

    <div class="container-fluid p-0">
        
        <!-- Hero Section con immagine full width -->
        {{-- <section class="about-hero mt-5">
            <img src="https://picsum.photos/1920/600?random=1" alt="About Header" class="w-100" style="height: 75vh; object-fit: cover;">
        </section> --}}

        <!-- Bio Section -->
        <section class="container py-5 mb-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="{{ asset('images/foto portrait.png') }}" 
                        alt="Serena L'Assainato" 
                        class="img-fluid shadow-lg"
                        style="width: 100%; height: 600px; object-fit: cover;">
                </div>
                <div class="col-lg-7 ps-lg-5">
                    <h2 class="display-5 mb-4"">ABOUT ME</h2>
                    <div class="mt-auto">
                        <p class="mb-4">
                            La mia esperienza professionale spazia dalla progettazione urbana alla landscape architecture, 
                            con particolare attenzione alla sostenibilità e all'integrazione tra ambiente costruito e naturale. 
                            Ho lavorato in diversi studi internazionali, sviluppando una visione multiculturale del progetto architettonico.
                        </p>
                        <p>
                            Ogni progetto rappresenta un'opportunità per esplorare il dialogo tra spazio, funzione ed emozione, 
                            creando ambienti che migliorano la qualità della vita e rispettano l'ambiente circostante.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Immagine divisoria full width -->
        <section class="about-divider">
            <img src="{{ asset('images/section-nosfondo.png') }}" alt="Divider" class="w-100" style="height: 50vh; object-fit: cover;">
        </section>

        <!-- Curriculum Section -->
        <section class="container py-5 my-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <h2 class="display-5 text-center">CURRICULUM</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    
                    <!-- 2025 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-bold">2025</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-0">Architecture for Landscape program, <strong>YACademy</strong> - Bologna, Italy</p>
                        </div>
                    </div>

                    <!-- 2024 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-bold">2024</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-0">Architect at <strong>Mongiello&Plisson</strong> - Colmar, France</p>
                        </div>
                    </div>

                    <!-- 2023 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-bold">2023</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-2">Architect at <strong>SURF Engineering Landscape & Urban Design</strong> - Rome, Italy</p>
                        </div>
                    </div>

                    <!-- 2022 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year mt-auto">
                            <h4 class="fw-bold mb-0">2022</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-2">Interior architect at <strong>Architectural Spaces</strong> - Galway, Ireland</p>
                            <p class="mb-0">Architect at <strong>AL'Architetto</strong> - Grottaglie, Italy</p>
                        </div>
                    </div>

                    <!-- 2021 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year mt-auto">
                            <h4 class="fw-bold mb-0">2021</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-2">English B2 Certification</p>
                            <p class="mb-0">Master of Architecture at <strong>ENSAS</strong> - Strasbourg, France</p>
                        </div>
                    </div>

                    <!-- 2020 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-bold">2020</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-0">Architectural internship at <strong>Valentina Seravalle Architect</strong> - Taranto, Italy</p>
                        </div>
                    </div>

                    <!-- 2019 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-bold">2019</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-0">Bachelor of Architecture at <strong>ENSAS</strong> - Strasbourg, France</p>
                        </div>
                    </div>

                    <!-- 2018 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-bold">2018</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-0">Architectural internship at <strong>AL'Architetto</strong> - Grottaglie, Italy</p>
                        </div>
                    </div>

                    <!-- 2016 -->
                    <div class="cv-item row mb-4 pb-4 border-bottom">
                        <div class="col-md-2 cv-year mt-auto">
                            <h4 class="fw-bold mb-0">2016</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-2">Start of architectural studies - Strasbourg, France</p>
                            <p class="mb-0">French B2 Certification</p>
                        </div>
                    </div>

                    <!-- 2014 -->
                    <div class="cv-item row mb-4">
                        <div class="col-md-2 cv-year">
                            <h4 class="fw-bold">2014</h4>
                        </div>
                        <div class="col-md-10 cv-description">
                            <p class="mb-0">Scientific Diploma at <strong>Maria Pia</strong> - Taranto, Italy</p>
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