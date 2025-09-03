import './bootstrap';

import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Autoplay, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

window.Alpine = Alpine;
Alpine.start();
document.addEventListener("DOMContentLoaded", () => {
    // Swiper
    new Swiper('.testimonial-slider', {
        modules: [Autoplay, Pagination],
        loop: true,
        autoplay: { delay: 3000 },
        pagination: {
            el: '.testimonial-slider-pagination',
            clickable: true,
        },
    });

    const functionalitySelect = document.querySelector("#functionality_id");
    if (functionalitySelect) {
        new TomSelect(functionalitySelect, {
            plugins: ['remove_button'],
            persist: false,
            create: false,
            hideSelected: true,
        });
    }
});
