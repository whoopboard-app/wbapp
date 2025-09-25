<!-- create category modal -->
<div class="modal fade" id="createBoardCategoryModal" tabindex="-1" aria-labelledby="createBoardCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-scrollable modal-lg">
        <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="text-2xl font-bold text-gray-900" id="createBoardCategoryLabel">Knowledge Board Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kbarticle.storeBoardcategory') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3 mt-3">
                @csrf
                <div class="modal-body mt-2 pb-0">
                    <p class="form-para mb-3">
                        Set up a new category for your Knowledge Board. Define its name, parent category, status, and visibility.
                    </p>
                    <div class="card card-badge modal-note-card">
                        <p class="mb-0 text-primary label">
                            You can rename modules to match your business language. For example, change “Changelog” to “Announcements” or “Knowledge Board” to “Help Center.”
                        </p>
                    </div>
                    <div class="form-input border-0 p-0 mb-4 mt-2 d-flex align-items-center gap-3">
                        <div class="flex-grow-1">
                            <label for="board_id" class="input-label mb-1 fw-medium">
                                @customLabel('Knowledge Board')
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Select a knowledge board">
                                <i class="fa fa-question-circle"></i>
                            </span>
                            </label>
                            <select id="board_id" name="board_id" class="form-select rounded" required>
                                <option value="">Select Board</option>
                                @foreach($boards as $board)
                                    <option value="{{ $board->id }}">{{ $board->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Category Image -->
                    <div class="form-input border-0 p-0 mb-4 mt-2 d-flex align-items-center gap-3">
                        <!-- Image Upload -->
                        <div class="image-upload text-center">
                            <label for="imageAdd" style="cursor:pointer; display: inline-block;" class="input-label mb-1 fw-medium">
                                Image
                                <img src="assets/img/icon/add-image.svg" alt="Upload Image" width="41">
                            </label>
                            <input type="file" name="imageAdd" id="imageAdd" class="d-none">
                        </div>

                        <!-- Category Name -->
                        <div class="flex-grow-1">
                            <label for="categoryName" class="input-label mb-1 fw-medium">
                                Category Name
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add category name">
                <i class="fa fa-question-circle"></i>
            </span>
                            </label>
                            <input type="text" id="categoryName" name="categoryName"
                                   class="input-field w-100 rounded" placeholder="Placeholder" required>
                        </div>
                    </div>
                    <!-- Parent Category -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="parentCategory" class="input-label mb-1 fw-medium">
                            Parent Category
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Select parent category">
                            <i class="fa fa-question-circle"></i>
                        </span>
                                        </label>
                        <select class="input-field w-100 rounded border" id="parentCategory" name="parent_id">
                            <option value="">None</option>
                        </select>
                    </div>
                    <!-- Display as Popular -->
                    <div class="form-input mb-4 mt-2 rounded border w-100">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="isPopular" name="is_popular" checked>
                            <label class="form-check-label" for="isPopular">
                                Display as popular article
                            </label>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="shortDesc" class="input-label mb-1 fw-medium">
                            Short Description
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add description">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </label>
                        <textarea rows="3" id="shortDesc" name="short_desc" class="input-field w-100 rounded" placeholder="Placeholder"></textarea>
                    </div>

                    <!-- Status -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="status" class="input-label mb-1 fw-medium">
                            Status
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Category status">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </label>
                        <select class="input-field w-100 rounded border" id="status" name="status" required>
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <!-- Hide From Structure -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label class="form-label fw-medium">Hide From Structure</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="categoryVisibility" name="visibility" checked>
                            <label class="form-check-label" for="categoryVisibility" id="categoryVisibilityLabel">
                                Private (Hidden from structure)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
        document.getElementById('board_id').addEventListener('change', function () {
        let boardId = this.value;
        let parentSelect = document.getElementById('parentCategory');

        if (boardId) {
        fetch(`/kbarticle/boards/${boardId}/categories`)
        .then(response => response.json())
        .then(data => {
        parentSelect.innerHTML = '<option value="">None</option>'; // reset
        data.forEach(function(category) {
        let option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        parentSelect.appendChild(option);
    });
    });
    } else {
        parentSelect.innerHTML = '<option value="">None</option>';
    }
    });
const catToggle = document.getElementById("categoryVisibility");
    const catLabel = document.getElementById("categoryVisibilityLabel");

    function updateCategoryVisibilityLabel() {
        if (catToggle.checked) {
            catLabel.textContent = "Private (Hidden from structure)";
        } else {
            catLabel.textContent = "Public (Your category is visible)";
        }
    }
    updateCategoryVisibilityLabel();
    catToggle.addEventListener("change", updateCategoryVisibilityLabel);
</script>
