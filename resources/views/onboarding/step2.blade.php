@extends('layouts.navbar-layout')
@section('content')
    <section class="step-section">
        <div class="container-fluid">
            <div class="step-section-wrapper d-flex flex-column">
                <form action="{{ route('onboarding.storeStep2') }}" method="POST" class="step-form form d-flex flex-column mx-auto">
                    @csrf
                    <div class="form-title">
                        <h2 class="fw-bold mb-1 text-dark fs-2">What’s your product’s name?</h2>
                        <p class="fw-medium mb-0">
                            Secure your custom domain extension for your board—your dedicated space for feedback, changelog, and knowledge base.
                        </p>
                    </div>
                    <div class="form-input-wrapper d-flex flex-column gap-3">
                        <div class="form-input border-0">
                            <label for="product_name" class="input-label mb-1 fw-medium">Your product name</label>
                            <input type="text" id="product_name" name="product_name" class="input-field w-100 rounded"
                                   placeholder="Placeholder" required>
                        </div>

                        <div class="form-input border-0">
                            <label for="current_url" class="input-label mb-1 fw-medium">Current website URL</label>
                            <div style="display:flex; align-items:center;">
                                <input type="text" value="https://www." readonly
                                       style="width:120px; border-right:0; border-radius:5px 0 0 5px; background:#f1f1f1;">
                                <input type="text" id="current_url" name="current_url"
                                       class="input-field w-100 rounded-0"
                                       placeholder="example.com" required
                                       style="border-radius:0 5px 5px 0;">
                            </div>
                        </div>

                        <div class="form-input border-0">
                            <label for="subdomain" class="input-label mb-1 fw-medium">Custom domain extension</label>
                            <div class="form-input-group d-flex">
                                <input type="text" id="subdomain" name="subdomain"
                                       class="input-field w-100 flex-shrink-1 rounded rounded-end-0 border-end-0 bg-white"
                                       placeholder="yourproduct" required>
                                <input type="button"
                                       class="input-field input-btn rounded rounded-start-0 flex-grow-1 text-start"
                                       value="insighthq.app" disabled>
                            </div>
                        </div>

                        <div class="form-input border-0">
                            <label for="full_name" class="input-label mb-1 fw-medium">Your full name</label>
                            <input type="text" id="full_name" name="full_name" class="input-field w-100 rounded"
                                   placeholder="John Doe" required>
                        </div>
                    </div>
                    <button type="submit" class="form-btn theme-btn fw-semibold w-100 rounded border-0">Continue</button>
                </form>
            </div>
        </div>
    </section>
@endsection
