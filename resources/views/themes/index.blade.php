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
                    $defaultTheme = $themes->first();
                    $activeTheme = $userTheme ?? $defaultTheme;
                    $isCustomized = !is_null($userTheme);
                    @endphp
                    <form id="customizeThemeForm_{{ $activeTheme->id }}" method="POST" action="{{ route('themes.customize') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="theme_id" value="{{ $activeTheme->id }}">
                        <input type="hidden" name="theme_title" value="{{ $activeTheme->theme_title }}">
                        <input type="hidden" name="short_description" value="{{ $activeTheme->short_description ?? $activeTheme->description }}">
                        <input type="hidden" name="welcome_message" value="{{ $activeTheme->welcome_message }}">
                        <input type="hidden" name="theme_flag" value="{{ $activeTheme->theme_flag ?? 0 }}">

                        @include('themes.partials._theme_card', [
                            'theme' => $activeTheme,
                            'isEditable' => true,
                            'isCustomized' => $isCustomized
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
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

