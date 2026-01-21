import AOS from 'aos';
import 'aos/dist/aos.css';
import Swiper from 'swiper';
import { Navigation, FreeMode } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

// Inizializza AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out-cubic',
    once: false,
    startEvent: 'load'
});

// Inizializza Swiper
document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.related-swiper', {
        modules: [Navigation, FreeMode],
        slidesPerView: 1,
        spaceBetween: 24,
        grabCursor: true,
        freeMode: true,          // ← SCROLL CONTINUO
        watchOverflow: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 4,
            }
        }
    });
});

// Funzionalità di toggle per la descrizione del progetto
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleDescBtn');
    if (!toggleBtn) return;

    const carouselCol = document.getElementById('carouselCol');
    const infodescCol = document.getElementById('infodescCol');
    const infoCol = document.getElementById('infoCol');
    const descriptionCol = document.getElementById('descriptionCol');

    toggleBtn.addEventListener('click', function() {
        if(toggleBtn.textContent === '+') {
            carouselCol.classList.replace('col-md-8', 'col-md-4');
            infodescCol.classList.replace('col-md-4', 'col-md-8');
            infoCol.classList.add('d-none');
            descriptionCol.classList.remove('d-none');
            toggleBtn.textContent = '-';
        } else {
            carouselCol.classList.replace('col-md-4', 'col-md-8');
            infodescCol.classList.replace('col-md-8', 'col-md-4');
            infoCol.classList.remove('d-none');
            descriptionCol.classList.add('d-none');
            toggleBtn.textContent = '+';
        }
    });
});