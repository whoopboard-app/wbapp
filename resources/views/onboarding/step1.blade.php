@extends('layouts.navbar-layout')
@section('content')
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @if (session('info'))
            <x-alert type="info" :message="session('info')" />
        @endif

        @if (session('warning'))
            <x-alert type="warning" :message="session('warning')" />
        @endif
    <section class="step-section bg-white pt-4">
        <div class="container-fluid">
            <div class="step-section-wrapper d-flex flex-column">
                <form action="{{ route('onboarding.storeStep1') }}" method="POST" class="step-form form d-flex flex-column mx-auto w-full max-w-lg px-14">
                    @csrf
                    <div class="form-title">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2 tracking-wide">
                           ✨ Welcome, <span class="capitalize ">{{ Auth::user()->name }}</span>!
                        </h1>
                        <p class="font-normal text-gray-500">
                          Let’s make this easy — choose the modules you’re most excited about, and we’ll set things up.
                        </p>
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
