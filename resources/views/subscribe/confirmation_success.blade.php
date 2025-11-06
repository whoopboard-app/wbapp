<x-guest-layout>
    <style>
        .flex.flex-col.items-center.p-4.relative {
            padding: 0px !important;
        }
    </style>
    <div class="container py-0">
        <div class="card p-0 bg-white">
            <div class="border-title">
                <h2 class="text-xl font-semibold">Subscribe Confirmation</h2>
                
            </div>
            <div class="content-body">
               
                    <div class=" d-flex flex-column gap-10">
                                     
                    <div class="form-input">
                        <img src="{{ asset('assets/img/icon/check-circle-1.svg') }}" alt="">
                        <p class="form-para color-support fw-medium small mt-2 mb-0">
                        Your have confirmed your subscriptions   
                            </p>
                    </div>
                    
                    
                    
                </div>
                <a href="{{ route('themes.details', ['subdomain' => $tenant->custom_url]) }}" class="theme-btn w-full justify-center text-sm text-center inline-block"> Continue to Changelog </a>
                  
            </div>
        </div>
    </div>
</x-guest-layout>
