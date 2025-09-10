@extends('layouts.navbar-cross')

@section('content')
    <div class="container pt-3 my-md-auto" style="margin-left: 3%; width: 80%;">
        <div class="row">
            <div class="col-10 offset-2">
                <div class="text-start mb-4">
                    <h4 class="text-2xl md:text-2xl font-bold text-gray-900">
                        🎨 Choose Your Theme
                    </h4>
                    <p class="text-muted">
                        Make your board truly yours. Pick a theme that matches your brand’s style — you can always change it later.
                    </p>
    @php
        $defaultTheme = $themes->first(); // assuming the first theme is default
    @endphp
    {{-- Default Theme Form --}}
    <form id="customizeThemeForm" method="POST" action="{{ route('themes.customize') }}">
        @csrf
        <input type="hidden" name="theme_id" value="{{ $defaultTheme->id }}">
        <input type="hidden" name="theme_title" value="{{ $defaultTheme->name }}">
        <input type="hidden" name="short_description" value="{{ $defaultTheme->description }}">
        @include('themes.partials._theme_card',['theme' => $defaultTheme, 'isEditable' => true])
    </form>

    {{-- User Theme (if exists) --}}
    @if($userTheme)
    <form id="customizeThemeForm" method="POST" action="{{ route('themes.customize') }}">
        @csrf
        <input type="hidden" name="theme_id" value="{{ $userTheme->id }}">
        <input type="hidden" name="theme_title" value="{{ $userTheme->name }}">
        <input type="hidden" name="short_description" value="{{ $userTheme->short_description }}">
        @include('themes.partials._theme_card', ['theme' => $userTheme, 'isEditable' => true])
    </form>
    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="theme-setting-wrapper rounded" style="margin-left: 17%; width: 70%;">
        <!-- Customize Button -->
        <button class="theme-btn rounded border-0 btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#customizeTheme">Customize Theme</button>
        <button class="theme-btn rounded border-0 btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#baseConfiguration">Add Base Configuration</button>
    </div>
    {{-- Include the customize modal but keep it hidden initially --}}
    @include('themes.partials.customize-modal', ['userTheme' => $defaultTheme])
    @include('themes.partials.customize-modal', ['userTheme' => $userTheme])
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passwordToggle = document.getElementById("passwordToggle");
            const passwordField = document.getElementById("passwordField");

            if (passwordToggle) {
                // Show it immediately if already checked (editing case)
                passwordField.style.display = passwordToggle.checked ? "block" : "none";

                passwordToggle.addEventListener("change", function () {
                    passwordField.style.display = this.checked ? "block" : "none";
                });
            }
        });
    </script>
@endsection

