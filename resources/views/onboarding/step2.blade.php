@extends('layouts.navbar-layout')
@section('content')
@if ($errors->any())
    <x-alert type="error" :message="$errors->first()" />
@endif
    <section class="step-section pt-4">
        <div class="container-fluid">
            <div class="step-section-wrapper d-flex flex-column">
                <form action="{{ route('onboarding.storeStep2') }}" method="POST" class="step-form form d-flex flex-column mx-auto max-w-lg">
                    @csrf
                    <div class="form-title">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2 tracking-wide">
                          Step: Set Up Your Product Space
                        </h1>
                        <p class="font-normal text-gray-500">
                          Secure a custom domain extension for your board — your dedicated space for feedback, changelog, and knowledge base.
                        </p>
                    </div>
                    <div class="form-input-wrapper d-flex flex-column gap-3 mt-0">
                        <div class="">
                            <div class="flex items-center gap-2">
                                <x-input-label for="product_name" :value="__('Your Product / Company Name ')" />
                                <i class="fa-solid fa-circle-question cursor-pointer relative"
                                    x-data="{ show: false }"
                                    @mouseenter="show = true"
                                    @mouseleave="show = false"
                                    :class="show ? 'text-blue-600' : 'text-gray-300'">

                                        <!-- Icon -->

                                        <!-- Tooltip -->
                                        <div x-show="show"
                                            x-transition
                                            class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-sm px-2 py-2 border border-gray-700 rounded-lg font-medium shadow-lg z-50 font-sans whitespace-normal inline-block min-w-[200px] max-w-xs">
                                            Add product name.
                                            <div class="absolute top-[50] left-1/2 -translate-x-1/2 w-3 h-3 bg-black rotate-45"></div>
                                        </div>

                                </i>
                            </div>
                            <input type="text" id="product_name" name="product_name" class="input-field w-100 rounded mt-1 focus:border focus:border-gray-400 focus:ring-0"
                                   placeholder="Placeholder" required>
                        </div>

                        <div class="">
                            <div class="flex items-center gap-2">
                                <x-input-label for="current_url" :value="__('Current website URL')" />
                                <i class="fa-solid fa-circle-question cursor-pointer relative"
                                    x-data="{ show: false }"
                                    @mouseenter="show = true"
                                    @mouseleave="show = false"
                                    :class="show ? 'text-blue-600' : 'text-gray-300'">

                                        <!-- Icon -->

                                        <!-- Tooltip -->
                                        <div x-show="show"
                                            x-transition
                                            class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-sm px-2 py-2 border border-gray-700 rounded-lg font-medium shadow-lg z-50 font-sans whitespace-normal inline-block min-w-[200px] max-w-xs">
                                            Add product name.
                                            <div class="absolute top-[50] left-1/2 -translate-x-1/2 w-3 h-3 bg-black rotate-45"></div>
                                        </div>

                                </i>
                            </div>
                            <input type="text" id="current_url" name="current_url" class="input-field w-100 rounded mt-1 focus:border focus:border-gray-400 focus:ring-0"
                                   placeholder="https://www." required>


                        </div>

                        <div class="">
                            <label for="subdomain" class="input-label mb-1 fw-medium">Choose Your Sub-Domain</label>
                            <div class="form-input-group d-flex">
                                <input type="text" id="subdomain" name="subdomain"
                                       class="input-field w-100 flex-shrink-1 rounded rounded-end-0 border-end-0 bg-white focus:border focus:border-gray-400 focus:ring-0"
                                       placeholder="https://www." required>
                                <input type="button"
                                       class="input-field input-btn rounded rounded-start-0 flex-grow-1 text-start"
                                       value="insighthq.app" disabled>
                            </div>
                            <div class="form-msg-container d-flex flex-column gap-1">
                                <p id="subdomain-success" class="form-msg success-msg d-flex align-items-center gap-2 fw-medium mb-0 d-none">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span></span>
                                </p>
                                <p id="subdomain-error" class="form-msg error-msg d-flex align-items-center gap-2 fw-medium mb-0 d-none">
                                    <i class="fa-solid fa-info-circle"></i>
                                    <span></span>
                                </p>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="form-btn theme-btn fw-semibold w-100 rounded border-0">Continue</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let userEdited = false;
            $('#subdomain').on('input', function () {
                userEdited = true;
            });
            $('#product_name').on('input', function () {
                if (!userEdited) {
                    let companyName = $(this).val();
                    let slug = companyName
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '')
                        .replace(/^-+|-+$/g, '');

                    $('#subdomain').val(slug);
                }
            });

            $('#subdomain').on('blur', function () {
                let subdomain = $(this).val();
                $('#subdomain-error, #subdomain-success').addClass('d-none');

                if (subdomain.length > 0) {
                    $.ajax({
                        url: "{{ route('check.domain') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            subdomain: subdomain
                        },
                        success: function (response) {
                            if (response.available) {
                                $('#subdomain-success span').text(response.message);
                                $('#subdomain-success').removeClass('d-none');
                            } else {
                                $('#subdomain-error span').text(response.message);
                                $('#subdomain-error').removeClass('d-none');
                            }
                        }
                    });
                }
            });
        });

    </script>
@endsection
