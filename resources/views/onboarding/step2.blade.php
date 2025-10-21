@extends('layouts.navbar-layout')
@section('content')
@if ($errors->any())
    <x-alert type="error" :message="$errors->first()" />
@endif
<section class="section-content-center">
    <div class="container py-4">
        <form action="{{ route('onboarding.storeStep2') }}" method="POST" class="mb-3 form mx-auto w-50">
            @csrf
            <div class="card p-0 bg-white mb-3 px-4 py-2">
                <!-- Header -->
                <div class="d-flex align-items-center border-title justify-content-between mb-2 border-bottom pb-2"
                     style="margin-left: -1.5rem; margin-right: -1.5rem; padding: 0 1.5rem;">
                    <h4 class="fw-medium mb-0">Set Up Your Product Space</h4>
                    <a href="{{ route('onboarding.step1') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Back to Step 1</a>
                </div>

                <!-- Body -->
                <div class="content-body">
                    <p class="mb-0 label fw-medium color-support text-gray-500">
                        Secure a custom domain extension for your board — your dedicated space for feedback, changelog, and knowledge base.
                    </p>

                    <div class="d-flex flex-column gap-3">
                        <!-- Product Name -->
                        <div class="">
                            <label for="product_name" class="input-label mb-1 fw-medium mt-2">
                                Your Product / Company Name
                            </label>
                            <input type="text" id="product_name" name="product_name"
                                   class="input-field w-100 rounded mt-1 focus:border focus:border-gray-400 focus:ring-0"
                                   placeholder="Placeholder" required>
                        </div>

                        <!-- Current URL -->
                                <div class="d-flex align-items-end gap-2">
                                    <!-- Protocol Select -->
                                    <div class="col-lg-3">
                                        <div class="w-100">
                                            <label for="url" class="input-label mb-2 fw-medium">URL</label>
                                            <select name="url" id="url" class="form-select" style="height: 39px;" required>
                                                <option value="">Select</option>
                                                <option value="https://">https://</option>
                                                <option value="http://">http://</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                    <!-- Website Input -->
                                    <div class="flex-grow-1">
                                        <div class="w-100">
                                            <label for="current_url" class="input-label mb-1 fw-medium">Current website URL</label>
                                            <input type="text" id="current_url" name="current_url"
                                                   class="input-field w-100 rounded mt-1 focus:border focus:border-gray-400 focus:ring-0 bg-white"
                                                   placeholder="www.example.com" required>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        <!-- Subdomain -->
                        <div class="">
                            <label for="subdomain" class="input-label mb-1 fw-medium">Choose Your Sub-Domain</label>
                            <div class="form-input-group d-flex">
                                <input type="text" id="subdomain" name="subdomain"
                                       class="input-field w-100 flex-shrink-1 rounded rounded-end-0 border-end-0 bg-white focus:border focus:border-gray-400 focus:ring-0"
                                       placeholder="mycompany" required>
                                <input type="button"
                                       class="input-field input-btn rounded rounded-start-0 flex-grow-1 text-start"
                                       value="insighthq.app" disabled>
                            </div>
                            <div class="form-msg-container d-flex flex-column gap-1">
                                <p id="subdomain-success" class="form-msg success-msg d-flex align-items-center gap-2 fw-medium mb-0 d-none mb-2">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span></span>
                                </p>
                                <p id="subdomain-error" class="form-msg error-msg d-flex align-items-center gap-2 fw-medium mb-2 d-none">
                                    <i class="fa-solid fa-info-circle"></i>
                                    <span></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer gap-2 p-2 pb-0 d-flex justify-content-start" style=" margin-left: -1.5rem; margin-right: -1.5rem; background-color: #FCFCFC;">
                    <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block border-0 ml-4">Save</button>
                    <a href="{{ route('onboarding.step1') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>
                </div>
            </div>
        </form>
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
