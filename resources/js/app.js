import './bootstrap';

import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Autoplay, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

window.Alpine = Alpine;

Alpine.start();

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
    new Swiper('.testimonial-slider', {
        modules: [Autoplay, Pagination],
        loop: true,
        autoplay: { delay: 3000 },
        pagination: {
            el: '.testimonial-slider-pagination',
            clickable: true,
        },
    });
});