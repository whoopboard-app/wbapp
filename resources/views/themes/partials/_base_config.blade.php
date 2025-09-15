<div class="modal fade" id="baseConfiguration" tabindex="-1" aria-labelledby="baseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header">
                <div class="mb-0">
                    <h5 class="text-2xl md:text-2xl font-bold text-gray-900" id="customizeThemeLabel">
                        Customize Your Theme
                    </h5>
                </div>
                <button type="button" class="modal-close bg-transparent border-0 ms-auto d-flex align-items-center justify-content-center" data-bs-dismiss="modal" aria-label="Close">
                    <img src="assets/img/icon/close-dark.svg" alt="">
                </button>
            </div>

            <div class="modal-body">
                <p class="form-para">
                    Add your Google Analytics code and define your product’s meta title and description. These settings help you track performance and improve your board’s SEO.
                </p>
                <form id="baseForm" action="{{ route('themes.base-config') }}" method="POST" class="d-flex flex-column gap-3">
                    @csrf

                    <div class="form-input border-0 p-0 mb-2 mt-2">
                        <label for="meta-title" class="input-label mb-1 fw-medium">
                            Meta Title
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Meta Title">
                <i class="fa fa-question-circle hover-blue"></i>
                             </span>
                        </label>
                        <input type="text" id="meta-title" name="meta_title" class="input-field w-100 rounded border" placeholder="Placeholder" required>
                    </div>

                    <div class="form-input border-0 p-0 mb-2 mt-2">
                        <label for="meta-desc" class="input-label mb-1 fw-medium">
                            Meta Description
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Meta Description">
                <i class="fa fa-question-circle hover-blue"></i>
                             </span>
                        </label>
                        <input type="text" id="meta-desc" name="meta_description" class="input-field w-100 rounded border" placeholder="Placeholder" required>
                    </div>

                    <div class="form-input border-0 p-0 mb-2 mt-2">
                        <label for="meta-keywords" class="input-label mb-1 fw-medium">
                            Meta Keywords
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Meta Keywords">
                <i class="fa fa-question-circle hover-blue"></i>
                             </span>
                        </label>
                        <input type="text" id="meta-keywords" name="meta_keywords" class="input-field w-100 rounded border" placeholder="Placeholder" required>
                    </div>

                    <div class="form-input border-0 p-0 mt-2">
                        <label for="google-analytics" class="input-label mb-1 fw-medium">
                            Google Analytics
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Google Analytics">
                <i class="fa fa-question-circle hover-blue"></i>
                             </span>
                        </label>
                        <textarea rows="3" id="google-analytics" name="google_analytics" class="input-field w-100 rounded border" placeholder="Placeholder" required></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-start border-top-0">
                <button type="submit" form="baseForm" class="theme-btn fw-semibold rounded border-0">
                    Update
                </button>
                <button type="button" class="theme-btn secondary fw-semibold rounded boarder" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
