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
        <section class="section-content-center" style="background-color: #f7f8fa;">
            <div class="container py-4">
                <form action="{{ route('onboarding.storeStep1') }}" method="POST" class="mb-3 form mx-auto w-50">
                    @csrf
                <div class="card bg-white mb-3 px-4 py-2">
                        <!-- Header -->
                    <div class="d-flex align-items-center border-title justify-content-between pb-2 border-bottom"
                         style="margin-left: -1.5rem; margin-right: -1.5rem; padding: 0 1.5rem;">
                            <h4 class="fw-medium mb-0">What’s your main goal today</h4>
                        <button type="cancel" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block ml-3">Cancel</button>
                        </div>

                        <!-- Body -->
                        <div class="content-body mb-4">
                            <p class="mb-0 label fw-medium color-support py-3 text-gray-500">
                                Select all the functionalities you’d like to get started with in InsightHQ
                            </p>

                            <div class="onboard-steps d-flex flex-column gap-3 mt-10px">
                                @foreach($products as $product)
                                    <div class="onboard-step">
                                        <input type="checkbox"
                                               id="step-{{ $product->id }}"
                                               name="functionalities[]"
                                               value="{{ $product->id }}"
                                               class="visually-hidden"
                                               @if(in_array($product->id, $selectedFunctionalities)) checked @endif>

                                        <label for="step-{{ $product->id }}" class="d-block rounded-1">
                                            <div class="d-flex gap-2 mb-2">
                                                <img src="{{ asset('assets/img/icon/check-circle.svg') }}"
                                                     alt="check circle"
                                                     class="check-icon">
                                                <h6 class="step-title fw-semibold mb-0 flex-grow-1">{{ $product->product_name }}</h6>
                                            </div>
                                            <p class="step-desc mb-0">{{ $product->product_description }}</p>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Footer -->
                    <div class="card-footer d-flex justify-content-start border-top px-4 pt-2 pb-0"
                         style="margin-left: -1.5rem; margin-right: -1.5rem; border: 0px solid #E1E1E0; background-color: #FCFCFC;">
                        <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block">Continue</button>
                        <button type="cancel" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block ml-3">Cancel</button>
                    </div>
                    </div>
                </form>
            </div>
        </section>

@endsection
