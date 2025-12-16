<x-layout>
    
    <div class="position-absolute top-0 start-50 translate-middle-x text-white z-3 w-100">
        <x-navbar />
    </div>

    <!-- CAROSELLO DI SFONDO-->
    <section id="hero" class="position-relative">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://picsum.photos/1920/1080?random=1" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/1920/1080?random=2" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/1920/1080?random=3" class="d-block w-100" alt="Slide 3">
                </div>
            </div>
        </div>
    </section>

</x-layout>