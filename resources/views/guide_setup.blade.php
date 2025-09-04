@extends('layouts.app')
@php
    $disableSidebar = true;
@endphp
@section('content')
    <div class="py-1 ">
        <div class="max-w-5xl justify-content-center align-items-center min-vh-100">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg p-6 space-y-6 w-full ml-40">

                    <!-- Breadcrumb -->
                    <nav class="text-md-center text-black mb-3 text-base">
                        <ol class="list-reset flex space-x-2">
                            <li>
                                <a href="#" class="hover:text-black">Dashboard</a>
                                <span>/</span>
                            </li>
                            <li class="text-black">Quick Setup</li>
                        </ol>
                    </nav>

                    <!-- Title -->
                    <h5 class="text-2xl font-semibold text-black tracking-wide w-full mt-0">
                        Quick Setup Guide
                    </h5>

                    <p class="text-base text-black mt-1 text-lg">
                        ⚡ Let’s get your workspace ready! Customize each module below to match your product and brand.
                    </p>

                    <!-- Branding -->
                    <div class="border bg-indigo-50 rounded-lg p-4 w-100">
                        <h6 class="font-semibold text-gray-900 text-base">Branding & Theme</h6>
                        <p class="text-base text-gray-600 mb-3 text-lg">
                            Upload your logo and choose a theme color to make your board feel like home for your users.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <a href="#"
                               class="px-3 py-1.5 bg-white text-black border border-gray-300 rounded-md text-base font-medium flex items-center gap-1 hover:bg-gray-100">
                                Select Themes
                                <img src="{{ asset('assets/img/icon/enlarge.svg') }}" alt="">
                            </a>
                            <a href="#"
                               class="px-3 py-1.5 bg-white text-black border border-gray-300 rounded-md text-base font-medium flex items-center gap-1 hover:bg-gray-100">
                                System Configuration
                                <img src="{{ asset('assets/img/icon/enlarge.svg') }}" alt="">
                            </a>
                        </div>
                    </div>

                    <!-- Changelog -->
                    <div class="border bg-indigo-50 rounded-lg p-4 w-100">
                        <h6 class="font-semibold text-gray-900 text-base">Change log / Announcement</h6>
                        <p class="text-base text-gray-600 mb-3 text-lg">
                            Organize your product updates with categories and tags so users can easily explore new releases.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('guide.setup.changelog.category') }}"
                               class="px-3 py-1.5 bg-white text-black border border-gray-300 rounded-md text-base font-medium flex items-center gap-1 hover:bg-gray-100">
                                Create Category for Change log
                                <img src="{{ asset('assets/img/icon/enlarge.svg') }}" alt="">
                            </a>
                            <a href="{{ route('guide.setup.changelog.tags') }}"
                               class="px-3 py-1.5 bg-white text-black border border-gray-300 rounded-md text-base font-medium flex items-center gap-1 hover:bg-gray-100">
                                Changelog Tags
                                <img src="{{ asset('assets/img/icon/enlarge.svg') }}" alt="">
                            </a>
                            <a href="#"
                               class="px-3 py-1.5 bg-white text-black border border-gray-300 rounded-md text-base font-medium flex items-center gap-1 hover:bg-gray-100">
                                System Configuration
                                <img src="{{ asset('assets/img/icon/enlarge.svg') }}" alt="">
                            </a>
                        </div>
                    </div>

{{--                    <!-- Knowledge Base -->
                    <div class="border bg-indigo-50 rounded-lg p-4">
                        <h6 class="font-semibold text-gray-900 text-base">Knowledge Base</h6>
                        <p class="text-base text-black mb-3">
                            Create categories and tags to structure your help articles, FAQs, and guides for quick navigation.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <a href="#"
                               class="px-3 py-1.5 bg-white text-black border border-gray-300 rounded-md text-base font-medium flex items-center gap-1 hover:bg-gray-100">
                                Knowledge Base Category
                                <img src="{{ asset('assets/img/icon/enlarge.svg') }}" alt="">
                            </a>
                            <a href="#"
                               class="px-3 py-1.5 bg-white text-black border border-gray-300 rounded-md text-base font-medium flex items-center gap-1 hover:bg-gray-100">
                                Knowledge Base Tags
                                <img src="{{ asset('assets/img/icon/enlarge.svg') }}" alt="">
                            </a>
                            <a href="#"
                               class="px-3 py-1.5 bg-white text-black border border-gray-300 rounded-md text-base font-medium flex items-center gap-1 hover:bg-gray-100">
                                System Configuration
                                <img src="{{ asset('assets/img/icon/enlarge.svg') }}" alt="">
                            </a>
                        </div>
                        <p class="mt-2 text-black font-medium text-base">Each module has its own system configuration</p>
                    </div>--}}

                    <!-- Continue Button -->
                    <div>
                        <button
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-base hover:bg-indigo-700 disabled:bg-gray-400 disabled:cursor-not-allowed"
                            disabled>
                            Update & Continue
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
