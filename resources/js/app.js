import './bootstrap';
import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Autoplay, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";

window.Alpine = Alpine;
Alpine.start();
document.addEventListener("DOMContentLoaded", () => {

    const dateInput = document.querySelector("#publishDate");
    if (dateInput) {
        flatpickr(dateInput, {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            altInput: true,
            altFormat: "F j, Y - h:i K",
            allowInput: false, // prevents manual typing
        });
    }
    const testimonialSlider = document.querySelector('.testimonial-slider');
    if (testimonialSlider) {
        new Swiper(testimonialSlider, {
            modules: [Autoplay, Pagination],
            loop: true,
            autoplay: { delay: 3000 },
            pagination: {
                el: '.testimonial-slider-pagination',
                clickable: true,
            },
        });
    }

    const selectIds = [
        "#functionality_id",
        "#categorySelect",
        "#tagsSelect",
        "#author",
        "#other_article_category",
        "#other_article_category2"
    ];

    const config = {
        plugins: ['remove_button'],
        persist: false,
        create: false,
        hideSelected: true,
    };

    selectIds.forEach(id => {
        const el = document.querySelector(id);
        if (el) {
            new TomSelect(id, config);
        }
    });

});
