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
                        @foreach($products as $product)
                            <div class="onboard-step">
                                <input type="checkbox" id="step-{{ $product->id }}"
                                       name="functionalities[]"
                                       value="{{ $product->id }}" {{-- or slug if you add it --}}
                                       class="visually-hidden">

                                <label for="step-{{ $product->id }}" class="d-block rounded-1">
                                    <div class="d-flex gap-2 mb-2">
                                        <h6 class="step-title fw-semibold mb-0 flex-grow-1">{{ $product->product_name }}</h6>
                                        <img src="{{ asset('assets/img/icon/check-circle.svg') }}"
                                             alt="check circle" class="check-icon">
                                    </div>
                                    <p class="step-desc mb-0">{{ $product->product_description }}</p>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="form-btn theme-btn fw-semibold w-100 rounded border-0">Continue</button>
                </form>
            </div>
        </div>
    </section>
@endsection
