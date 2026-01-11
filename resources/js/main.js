import AOS from 'aos';
import 'aos/dist/aos.css';

// Inizializza AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out-cubic',
    once: true,
    disable: 'mobile',
    startEvent: 'load'
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