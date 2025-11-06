@extends('layouts.app')

@section('content')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif
<style>
     main.flex-1.p-8.pb-48{
        padding-top : 0px !important;
        padding-left : 0px !important;
        padding-right : 0px !important;
    }
    .ts-wrapper {
        padding: 0 10px !important;
        border: 1px solid #d1d9e0;
    }
    .ts-control {
        border: none !important;
        align-content: center !important;
    }
</style>
<section class="section-content-center view-changelog main-content-wrapper">
    <div class="row">
            <div class="col-lg-12 view-changelog-details">
                    <div class="card p-0 bg-white mb-3">
                        <form action="{{ route('segmentation.store') }}" method="POST" class="form">
                            @csrf
                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 class="fw-medium mb-0">User Segmentation</h4>
                            <div class="btn-wrapper mb-0 d-flex align-items-center justify-content-center gap15 flex-wrap">
                                <button type="reset" class="theme-btn bg-white sm secondary     fw-semibold rounded d-inline-block">
                                    Cancel
                                </button>
                                
                            </div>
                        </div>
                        <div class="mx-auto p-3">
                            
                            
                            <div class="basic-information">
                                
                                <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="">
                                         <label for="title" class="input-label mb-1 fw-medium">
                                            Segmentation Name
                                        </label>
                                        <input 
                                            type="text" 
                                            id="title" 
                                            name="name" 
                                            class="input-field w-100 rounded" 
                                            placeholder="Placeholder"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="">
                                        <label for="status" class="input-label mb-1 fw-medium">
                                            Status of your Segmentation
                                        </label>
                                        <select class="input-field w-100 rounded border" id="status" name="status" required>
                                            <option value="">Placeholder</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                <div class=" ">
                            
                                        <label for="short-desc" class="input-label mb-1 fw-medium">Segmentation Description
                                        </label>
                                        <textarea id="short-desc" name="short-desc" rows="3" class="input-field w-100 rounded" placeholder="Placeholder" required></textarea>
                                    
                                </div>
                                </div>
                            
                            </div>
                            </div>
                            <div class="basic-information">
                            
                                <div class="form-condition-container border-bottom-0 mb-0 pb-0">
                            
                                <div class="">
                                     <label for="revenueRange" class="input-label mb-1 fw-medium">
                                        Revenue Range
                                    </label>
                                    <select id="revenueRange" name="revenueRange" class="input-field w-100 rounded border" required>
                                        <option value="">Select</option>
                                        <option value="1">0 - 10K</option>
                                        <option value="2">10K - 50K</option>
                                        <option value="3">50K - 100K</option>
                                        <option value="4">100K+</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="basic-information mt-3">
                                <div class="d-flex justify-content-between px-0 border-title">
                                    <h6 class="text-gray">Demographic Attributes</h6>
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                        <a href="#"><img src="{{ asset('assets/img/icon/help.svg') }}" alt=""></a>
                                    </span>
                                </div>
                                <p class="label mt-2">
                                    Add your component descriptions here                                       
                                </p>
                                <div class="form-condition-container border-bottom-0 mb-0 pb-0">
                                
                                <div class=" my-3">
                                    <label for="location" class="input-label mb-1 fw-medium">
                                        Location / Region
                                    </label>
                                    <select id="location" name="location" class="input-field w-100 rounded border" required>
                                        <option value="">Select</option>
                                        <option value="1">North America</option>
                                        <option value="2">Europe</option>
                                        <option value="3">Asia</option>
                                        <option value="4">Middle East</option>
                                        <option value="5">Africa</option>
                                        <option value="6">Australia</option>
                                    </select>
                                </div>
                                <div class=" mb-3">
                                    <label for="age" class="input-label mb-1 fw-medium">
                                        Age Range
                                    </label>
                                    <select id="age" name="age" class="input-field w-100 rounded border" required>
                                        <option value="">Select</option>
                                        <option value="1">18 – 24</option>
                                        <option value="2">25 – 34</option>
                                        <option value="3">35 – 44</option>
                                        <option value="4">45 – 54</option>
                                        <option value="5">55+</option>
                                    </select>   
                                </div>
                                <div class=" mb-3">
                                    <div class="d-flex justify-content-between">
                                       <label for="gender" class="input-label mb-1 fw-medium">
                                            Gender
                                        </label>
                                        <h6 class="color-support fw-normal label">[Optional]</h6>
                                    </div>
                                    
                                        <select id="gender" name="gender" class="input-field w-100 rounded border">
                                            <option value="">Select</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="language" class="input-label mb-1 fw-medium">
                                            Language / Locale
                                        </label>
                                        <h6 class="color-support fw-normal label">[Optional]</h6>
                                    </div>
                                    <select id="language" name="language" class="input-field w-100 rounded border">
                                        <option value="">Select</option>
                                        <option value="1">English</option>
                                        <option value="2">French</option>
                                        <option value="3">Arabic</option>
                                        <option value="4">Urdu</option>
                                    </select>
                                </div>

                            </div>
                            </div>
                            <div class="basic-information mt-3">
                                <div class="d-flex justify-content-between px-0 border-title">
                                    <h6 class="text-gray">Behavioral &amp; Account Attributes</h6>
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                        <a href="#"><img src="{{ asset('assets/img/icon/help.svg') }}" alt=""></a>
                                    </span>
                                </div>
                                <p class="label mt-2">
                                    Add your component descriptions here
                                </p>
                                <div class="form-condition-container border-bottom-0 mb-0 pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class=" my-3">
                                    <div class="d-flex justify-content-between">
                                       <label for="role" class="input-label mb-1 fw-medium">
                                            User Type / Role
                                        </label>
                                        <h6 class="color-support fw-normal label">[Optional]</h6>
                                    </div>
                                
                                        <select id="role" name="role" class="input-field w-100 rounded border">
                                            <option value="">Select</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Editor</option>
                                            <option value="3">Subscriber</option>
                                            <option value="4">Guest</option>
                                        </select>
                                </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="">
                                            <label for="tier" class="input-label mb-1 fw-medium">
                                                Plan Type / Subscription Tier
                                            </label>
                                            <select id="tier" name="tier[]" class="input-field w-100 rounded border" multiple required>
                                                <option value="">Select</option>
                                                <option value="1">Free</option>
                                                <option value="2">Basic</option>
                                                <option value="3">Premium</option>
                                                <option value="4">Enterprise</option>
                                            </select>
                                                
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="">
                                           <label for="engagement" class="input-label mb-1 fw-medium">
                                                Engagement Level
                                            </label>
                                            <select id="engagement" name="engagement" class="input-field w-100 rounded border" required>
                                                <option value="" >Select</option>
                                                <option value="1">Low</option>
                                                <option value="2">Medium</option>
                                                <option value="3">High</option>
                                                <option value="4">Very High</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="">
                                            <label for="frequency" class="input-label mb-1 fw-medium">
                                                Usage Frequency
                                            </label>
                                            <select id="frequency" name="frequency" class="input-field w-100 rounded border" required>
                                                <option value="">Select</option>
                                                <option value="1">Daily</option>
                                                <option value="2">Weekly</option>
                                                <option value="3">Monthly</option>
                                                <option value="4">Occasionally</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12 mt-3">
                                        <div class="">
                                            <div class="d-flex justify-content-between">
                                                <label for="segmentDate" class="input-label mb-1 fw-medium">Signup Date</label>
                                                <h6 class="color-support fw-normal label">[Optional]</h6>
                                            </div>
                                            <div class="position-relative form-group">
                                                <input type="text" id="segmentDate" name="signup_date" class="input-field rounded ps-5 w-100" placeholder="Select Date">
                                                <img src="{{ asset('assets/img/icon/calendar.svg') }}" class="position-absolute search-icon" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                   
                                </div>
                                
                            </div>
                            </div>
                        </div>
                    <div class="card-footer gap15 px-3 bg-white d-flex justify-content-start">
                       <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block">
                            Create Segment
                        </button>
                        <button type="reset" class="theme-btn bg-white sm secondary     fw-semibold rounded d-inline-block">
                                    Cancel
                                </button>
                        <a href="#" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Save a Draft</a>
                        
                    </div>
                    </form>
                </div>
            </div>
        
    </div>
</section>

@endsection