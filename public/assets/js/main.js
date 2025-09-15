(function ($) {
   "use strict";

   jQuery(document).ready(function ($) {
      // sidebar active
      $(".sidebar-toggle").click(function () {
         $(".sidebar, .sidebar-overlay").toggleClass("active");
      });
      $(".sidebar-overlay").click(function () {
         $(".sidebar, .sidebar-overlay").removeClass("active");
      });

      
      $('#publishDate').daterangepicker({
         singleDatePicker: true,
         showDropdowns: true,
         autoApply: true,
         locale: {
            format: 'MM/DD/YYYY'
         }
      });

      // Button toggle function
      function toggleButtons() {
         let inputVal = $("#publishDate").val();
         if (!inputVal) return;

         let parts = inputVal.split("/");
         let selectedDate = new Date(parts[2], parts[0] - 1, parts[1]); // MM/DD/YYYY
         let today = new Date();
         today.setHours(0, 0, 0, 0);

         if (selectedDate > today) {
            // Future date → Draft + Schedule
            $("#btnPublish").prop("disabled", true);
            $("#btnDraft, #btnSchedule").prop("disabled", false);
         } else {
            // Today or Past date → Publish + Draft
            $("#btnPublish, #btnDraft").prop("disabled", false);
            $("#btnSchedule").prop("disabled", true);
         }
      }

      // Run once on page load
      toggleButtons();

      // Run whenever date is picked
      $('#publishDate').on('apply.daterangepicker', function () {
         toggleButtons();
      });

      $("select").select2({
         width: '100%'
      });
      $(".select-inside-modal").select2({
         dropdownParent: $(".modal"),
         width: "100%",
      });

      $(".category-select").select2({
         tags: true,
         width: "100%",
         // allowClear: true,
      });

      // color picker active
      $(".color-picker").spectrum({
         color: "#0969DA",
      });

      // date range picker active
      $(function () {
         $('input[name="daterange"]').daterangepicker(
            {
               singleDatePicker: true,
               showDropdowns: true,
               minYear: 1901,
               maxYear: parseInt(moment().format("YYYY"), 10),
            },
         );
      });

      // data table active
      $(".datatable-active").DataTable({
         language: {
            search: "",
            searchPlaceholder: "Search or filters",
         },
      });


      $(".dt-filter-btn").on("click", function () {
         $(".dt-filter-btn").removeClass("active");
         $(this).addClass("active");

         var filterValue = $(this).data("filter");

         if (filterValue) {
            $(".datatable-active").search(filterValue).draw();
         } else {
            $(".datatable-active").search("").draw();
         }
      });
   }); //---document-ready-----
})(jQuery);

document.addEventListener("DOMContentLoaded", function () {
   var tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
   );
   var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
   });

   const successToastTrigger = document.getElementById(
      "success-toast-toggle-btn"
   );
   const errorToastTrigger = document.getElementById("error-toast-toggle-btn");
   const successToast = document.getElementById("success-toast");
   const errorToast = document.getElementById("error-toast");

   // Get Bootstrap toast instances
   const successToastBootstrap =
      bootstrap.Toast.getOrCreateInstance(successToast);
   const errorToastBootstrap = bootstrap.Toast.getOrCreateInstance(errorToast);

   // Function to hide all toasts
   function hideAllToasts() {
      successToastBootstrap.hide();
      errorToastBootstrap.hide();
   }

   if (successToastTrigger) {
      successToastTrigger.addEventListener("click", () => {
         hideAllToasts(); // Hide any open toast
         successToastBootstrap.show(); // Show success toast
      });
   }

   if (errorToastTrigger) {
      errorToastTrigger.addEventListener("click", () => {
         hideAllToasts(); // Hide any open toast
         errorToastBootstrap.show(); // Show error toast
      });
   }
});

// testimonial slider active
var testimonialSlider = new Swiper(".testimonial-slider", {
   loop: true,
   speed: 1000,
   pagination: {
      el: ".testimonial-slider-pagination",
      clickable: true,
   },
});

// // data table active
// new DataTable("#article-table");
