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
        const textareas = document.querySelectorAll('.short-desc');

        textareas.forEach(textarea => {
            const counter = textarea.parentElement.querySelector('.desc-counter');
            const max = textarea.getAttribute('maxlength');

            if (!counter || !max) return; // skip if not properly set

            function updateCounter() {
                const length = textarea.value.length;
                counter.textContent = `${length} / ${max} characters`;
                counter.style.color = length > max ? 'red' : '';
            }

            textarea.addEventListener('input', updateCounter);
            updateCounter();
        });

    const recdateInput = document.querySelector("#recDateTime");
    if (recdateInput) {
        flatpickr(recdateInput, {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            altInput: true,
            altFormat: "m/j/Y - h:i K",
            allowInput: true, // now it’s editable
        });
    }
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
        "#other_article_category2",
        "#linkchangelog",
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
