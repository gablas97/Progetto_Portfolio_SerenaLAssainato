import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    duration: 800,
    easing: 'ease-in-out-cubic',
    once: true,
    disable: 'mobile',
    startEvent: 'load'
});