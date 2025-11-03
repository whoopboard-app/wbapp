@extends('layouts.app')

@section('content')
<style>
    main.flex-1.p-8.pb-48{
        padding : 0px !important;
    }
    .badge.active, .badge.more-category {
        border: 1px solid #0969DA;
        color: #0969DA;
    }
</style>
<section class="section-content-center view-changelog main-content-wrapper">
    <div class="row">
        <div class="col-lg-9 view-changelog-details">
            <div class="card  p-0 bg-white mb-3">
                <div class="d-flex align-items-center border-title justify-content-between">
                    <h4 class="fw-medium mb-0">33 Impression</h4>
                        <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                        <a href="{{ route('announcement.list') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Back to Listing</a>
                            <div class="icon-box">
                                <a href="{{route('announcement.edit', $changelog->id)}}"><img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit"></a>
                                <div class="divider"></div>

                                <a href="#"
                                title="Activate">
                                    <img src="{{ asset('assets/img/icon/oval.svg') }}" alt="Activate">
                                </a>

                                <div class="divider"></div>
                                <form action="{{ route('announcement.destroy', $changelog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-transparent p-0">
                                        <img src="{{ asset('assets/img/icon/trash.svg') }}" alt="Delete" style="width: 16px;">
                                    </button>
                                </form>

                            </div>
                        </div>
                </div>
                    <div class="mx-auto p-3">
                <div class="d-flex justify-content-start">
                        <div class="d-inline-block">
                             <a href="#">
                                <span class="badge fw-normal bg-white {{ strtolower($changelog->status) }} rounded-pill">
                                    {{ ucfirst($changelog->status) }}
                                </span>
                            </a>
                        </div>
                </div>


                <div class="section-title mb-4 mt-12">
                        <h2 class="fw-semibold mb-2 pb-1">
                            {{ $changelog->title }}
                        </h2>
                        <div class="tags-wrapper d-flex flex-wrap">
                            @foreach($changelog->tag_names as $tag)
                                <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold">
                                    <span class="tag-color green d-block rounded-circle"></span> {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>


                    <div class="changelog-detail-item-list d-flex flex-column">
                        <div class="changelog-detail-item d-flex flex-column">
                            @if($changelog->feature_banner)
                                <div class="img-block mt-3 position-relative">
                                    <img src="{{ asset('storage/' . $changelog->feature_banner) }}" alt="banner" class="w-100 h-100 object-fit-cover">

                                    <!-- Expand Icon -->
                                    <button type="button" class="btn btn-light btn-sm position-absolute bottom-0 end-0 m-2 shadow expand-btn">
                                    <i class="fa fa-expand"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="changelog-detail-item-content text-black">

                                <p class="label">
                                    {!! nl2br(e($changelog->description)) !!}
                                </p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-footer gap15 bg-white d-flex justify-content-end">

                <a href="{{ route('announcement.list') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Back to Listing</a>
                <div class="icon-box">
                    <a href="{{route('announcement.edit', $changelog->id)}}"><img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit"></a>
                    <div class="divider"></div>

                    <a href="#"
                       title="Activate">
                        <img src="{{ asset('assets/img/icon/oval.svg') }}" alt="Activate">
                    </a>

                    <div class="divider"></div>
                    <form action="{{ route('announcement.destroy', $changelog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-transparent p-0">
                            <img src="{{ asset('assets/img/icon/trash.svg') }}" alt="Delete" style="width: 16px;">
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 view-changelog-stats">
        <div class="report-card mb-3 card align-items-start rounded bg-white">
            <h5 class="card-title sm mb-2 fw-semibold text-black">Reaction</h5>
            <div class="d-flex justify-content-start mb-2 gap-2">
                <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                                {{ $announcement->likes_percent ?? 0 }}%
                                <img src="{{ asset('assets/img/icon/thumbs-up.svg') }}" alt="like" class="icon-sm" width="15" height="15">
                            </span>
                            <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                                {{ $announcement->dislikes_percent ?? 0 }}%
                                <img src="{{ asset('assets/img/icon/thumbs-down.svg') }}" alt="dislike" class="icon-sm" width="15" height="15">
                            </span>

            </div>

            <h6 class="fw-semibold card-title sm">Was this reaction helpful?</h6>
            <p class="card-date mb-0">March 20, 2024 - March 20, 2025</p>
        </div>
        <div class="report-card mb-3 card align-items-start rounded bg-white">
            <h5 class="card-title sm mb-2 fw-semibold text-black">Unique View</h5>
            <span class="card-number d-block mb-2">440</span>
            <p class="card-date mb-0">March 20, 2024 - March 20, 2025</p>
        </div>
        <div class="report-card mb-3 card align-items-start rounded bg-white">
            <h5 class="card-title sm mb-2 fw-semibold text-black">Total Unique View</h5>
            <span class="card-number d-block mb-2">440</span>
            <p class="card-date">March 20, 2024 - March 20, 2025</p>
            <a href="#"><span class="badge bg-white border text-dark mb-2 rounded">Edit SEO URL <img src="assets/img/icons/edit.svg" alt=""></span></a>
            <a href="#"><span class="badge bg-white border text-dark rounded">View <img src="assets/img/icons/edit.svg" alt=""></span></a>
        </div>
    </div>
</div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.expand-btn').forEach(button => {
          button.addEventListener('click', function () {
            const img = this.previousElementSibling; // get the image above the button
            if (!img) return;

            // Create overlay
            const overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100vw';
            overlay.style.height = '100vh';
            overlay.style.background = 'rgba(0,0,0,0.95)';
            overlay.style.display = 'flex';
            overlay.style.justifyContent = 'center';
            overlay.style.alignItems = 'center';
            overlay.style.zIndex = '9999';
            overlay.style.cursor = 'zoom-out';

            // Create enlarged image
            const enlargedImg = document.createElement('img');
            enlargedImg.src = img.src;
            enlargedImg.style.width = '100vw';
            enlargedImg.style.height = '100vh';
            enlargedImg.style.objectFit = 'cover'; // fill full screen
            enlargedImg.style.objectPosition = 'center';
            overlay.appendChild(enlargedImg);
            document.body.appendChild(overlay);

            // Go fullscreen
            if (overlay.requestFullscreen) {
                overlay.requestFullscreen();
            } else if (overlay.webkitRequestFullscreen) { // Safari
                overlay.webkitRequestFullscreen();
            } else if (overlay.msRequestFullscreen) { // IE11
                overlay.msRequestFullscreen();
            }

            // Exit fullscreen + remove overlay on click
            overlay.addEventListener('click', () => {
                if (document.fullscreenElement) {
                    document.exitFullscreen();
                }
                overlay.remove();
            });
        });

        });
    });
</script>

@endsection
