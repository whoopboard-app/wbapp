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

    // const functionalitySelect = document.querySelector("#functionality_id");
    // if (functionalitySelect) {
    //     new TomSelect(functionalitySelect, {
    //         plugins: ['remove_button'],
    //         persist: false,
    //         create: false,
    //         hideSelected: true,
    //     });
    // }

    // list of all select IDs jahan TomSelect lagana hai
    const selectIds = [
        "#functionality_id",
        "#categorySelect",
        "#tagsSelect",
        "#author",
        "#other_article_category",
        "#other_article_category2"
    ];

    // common config
    const config = {
        plugins: ['remove_button'],
        persist: false,
        create: false,
        hideSelected: true,
    };

    // loop se sab pe TomSelect apply kar do
    selectIds.forEach(id => {
        const el = document.querySelector(id);
        if (el) {
            new TomSelect(id, config);
        }
    });
});
