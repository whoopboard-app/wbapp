@extends('layouts.navbar-layout')
@section('content')
    <section class="step-section bg-white">
        <div class="container-fluid">
            <div class="step-section-wrapper d-flex flex-column">
                <form action="{{ route('onboarding.storeStep1') }}" method="POST" class="step-form form d-flex flex-column mx-auto">
                    @csrf
                    <div class="form-title">
                        <h2 class="fw-bold mb-1 text-dark fs-2">What’s your main goal today</h2>
                        <p class="fw-medium mb-0">Select all the functionalities you’d like to get started with in InsightHQ</p>
                    </div>

                    <div class="onboard-steps d-flex flex-column gap-3">
                        <div class="onboard-step">
                            <input type="checkbox" id="step-1" name="functionalities[]" value="capture & manage feedback" class="visually-hidden">
                            <label for="step-1" class="d-block rounded-1">
                                <div class="d-flex gap-2 mb-2">
                                    <h6 class="step-title fw-semibold mb-0 flex-grow-1">Capture & manage feedback</h6>
                                    <img src="{{ asset('assets/img/icon/check-circle.svg') }}" alt="check circle" class="check-icon">
                                </div>
                                <p class="step-desc mb-0">Collect, organize, and analyze feedback effortlessly...</p>
                            </label>
                        </div>

                        <div class="onboard-step">
                            <input type="checkbox" id="step-2" name="functionalities[]" value="publish product updates" class="visually-hidden">
                            <label for="step-2" class="d-block rounded-1">
                                <div class="d-flex gap-2 mb-2">
                                    <h6 class="step-title fw-semibold mb-0 flex-grow-1">Publish product updates</h6>
                                    <img src="{{ asset('assets/img/icon/check-circle.svg') }}" alt="check circle" class="check-icon">
                                </div>
                                <p class="step-desc mb-0">Collect, organize, and analyze feedback effortlessly...</p>
                            </label>
                        </div>
                        <div class="onboard-step">
                            <input type="checkbox" id="step-3" name="functionalities[]" value="survey" class="visually-hidden">
                            <label for="step-3" class="d-block rounded-1">
                                <div class="d-flex gap-2 mb-2">
                                    <h6 class="step-title fw-semibold mb-0 flex-grow-1">Surveys</h6>
                                    <img src="{{ asset('assets/img/icon/check-circle.svg') }}" alt="check circle" class="check-icon">
                                </div>
                                <p class="step-desc mb-0">Collect, organize, and analyze feedback effortlessly. Turn insights into actionable improvements for a better user experience.</p>
                            </label>
                        </div>
                        <div class="onboard-step">
                            <input type="checkbox" id="step-4" name="functionalities[]" value="research workspace" class="visually-hidden">
                            <label for="step-4" class="d-block rounded-1">
                                <div class="d-flex gap-2 mb-2">
                                    <h6 class="step-title fw-semibold mb-0 flex-grow-1">Research Workspace</h6>
                                    <img src="{{ asset('assets/img/icon/check-circle.svg') }}" alt="check circle" class="check-icon">
                                </div>
                                <p class="step-desc mb-0">Collect, organize, and analyze feedback effortlessly. Turn insights into actionable improvements for a better user experience.</p>
                            </label>
                        </div>
                        <div class="onboard-step">
                            <input type="checkbox" id="step-5" name="functionalities[]" value="help & knowledge base" class="visually-hidden">
                            <label for="step-5" class="d-block rounded-1">
                                <div class="d-flex gap-2 mb-2">
                                    <h6 class="step-title fw-semibold mb-0 flex-grow-1">Help & Knowledge base</h6>
                                    <img src="{{ asset('assets/img/icon/check-circle.svg') }}" alt="check circle" class="check-icon">
                                </div>
                                <p class="step-desc mb-0">Collect, organize, and analyze feedback effortlessly. Turn insights into actionable improvements for a better user experience.</p>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="form-btn theme-btn fw-semibold w-100 rounded border-0">Continue</button>
                </form>
            </div>
        </div>
    </section>
@endsection
