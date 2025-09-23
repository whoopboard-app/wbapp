<div class="modal fade" id="createBoardModal" tabindex="-1" aria-labelledby="createBoardLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-scrollable custom-modal-width">
        <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="text-2xl font-bold text-gray-900" id="createBoardLabel">Knowledge Board</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kbarticle.storeBoard') }}" method="POST" class="d-flex flex-column gap-3 mt-3">
                @csrf

                <div class="modal-body mt-2">
                    <p class="form-para mb-3">
                        Set up a new board to organize your documentation. Define its name, description, status, and visibility.
                    </p>
                    <div class="card card-badge modal-note-card">
                        <p class="mb-0 text-primary label">
                            You can rename modules to match your business language. For example, change “Changelog” to “Announcements” or “Knowledge Board” to “Help Center.”
                        </p>
                    </div>
                    <!-- Board Name -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="boardName" class="input-label mb-1 fw-medium">
                            Board Name
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add board name">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </label>
                        <input type="text" id="boardName" name="boardName"
                               class="input-field w-100 rounded boarded" placeholder="Placeholder" required>
                    </div>

                    <!-- Board Description -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="boardDesc" class="input-label mb-1 fw-medium">
                            Board Description
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add board description">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </label>
                        <input type="text" id="boardDesc" name="boardDesc"
                               class="input-field w-100 rounded boarded" placeholder="Placeholder">
                    </div>

                    <!-- Board Type -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="boardType" class="input-label mb-1 fw-medium">
                            Board Type
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Board type">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </label>
                        <select class="input-field w-100 rounded border" id="boardType" name="boardType">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <!-- Document Type -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="docsType" class="input-label mb-1 fw-medium">
                            Document Type
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Document type">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </label>
                        <select class="input-field w-100 rounded border" id="docsType" name="docsType">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <!-- Hide from Structure -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label class="form-label fw-medium">Hide From Structure</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="visibility1" name="visibility" checked>
                            <label class="form-check-label" for="visibility1" id="visibilityLabel">
                                Private (Hidden from structure)
                            </label>
                        </div>
                    </div>
                    <!-- Public Board URL -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="bublicURL" class="input-label mb-1 fw-medium">Public Board URL</label>
                        <div class="form-input-group d-flex">
                            <input type="button" class="input-field input-btn rounded rounded-end-0 flex-grow-1 text-start"
                                   value="subdomain.insighthq.app" readonly>
                            <input type="url" id="bublicURL" name="bublicURL"
                                   class="input-field w-100 flex-shrink-1 rounded rounded-start-0 border-start-0 bg-white"
                                   placeholder="https://www.">
                        </div>
                    </div>

                    <!-- Embed Code -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="embedCode" class="input-label mb-1 fw-medium">
                            Embed Code
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add embed code">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </label>
                        <input type="text" id="embedCode" name="embedCode"
                               readonly class="input-field w-100 rounded" value="Placeholder">
                        <a href="#" onclick="embedCodeFunction(event)" class="fw-medium label"
                           data-bs-toggle="tooltip" data-bs-placement="right" title="Copy embed code" id="copyBtn">
                            Copy Embed Code
                        </a>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold">Save Board</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
        const toggle = document.getElementById("visibility1");
        const label = document.getElementById("visibilityLabel");

        function updateVisibilityLabel() {
        if (toggle.checked) {
        label.textContent = "Private (Hidden from structure)";
        } else {
            label.textContent = "Public (Your board is live and accessible at [subdomain])";
        }
        }
        updateVisibilityLabel();
        toggle.addEventListener("change", updateVisibilityLabel);
    function embedCodeFunction(event) {
        event.preventDefault();
        const embedInput = document.getElementById("embedCode");
        embedInput.select();
        embedInput.setSelectionRange(0, 99999); // For mobile
        navigator.clipboard.writeText(embedInput.value);
        alert("Embed code copied: " + embedInput.value);
    }
</script>
