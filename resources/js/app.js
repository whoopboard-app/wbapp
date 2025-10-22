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
        const statusSelect = document.querySelector("#status");
        const btnPublish = document.querySelector("#btnPublish");
        const btnSchedule = document.querySelector("#btnSchedule");

        if (dateInput) {
            flatpickr(dateInput, {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                altInput: true,
                altFormat: "F j, Y - h:i K",
                allowInput: false,
                onChange: function(selectedDates) {
                    if (selectedDates.length === 0) return;
                    const selectedDate = selectedDates[0];
                    const now = new Date();

                    if (selectedDate.getTime() > now.getTime() + 60000) {
                        statusSelect.value = "schedule";
                        btnSchedule.disabled = false;
                        btnPublish.disabled = true;

                        btnSchedule.classList.remove("secondary");
                        btnSchedule.classList.add("theme-btn");
                        btnPublish.classList.add("secondary");
                    } else {
                        if (statusSelect.value === "schedule") {
                            statusSelect.value = "active";
                        }
                        btnPublish.disabled = false;
                        btnSchedule.disabled = true;

                        btnPublish.classList.remove("secondary");
                        btnPublish.classList.add("theme-btn");
                        btnSchedule.classList.add("secondary");
                    }
                },
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
