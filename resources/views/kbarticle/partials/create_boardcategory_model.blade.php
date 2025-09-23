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

                <div class="modal-body mt-2">
                    <p class="form-para mb-3">
                        Set up a new category for your Knowledge Board. Define its name, parent category, status, and visibility.
                    </p>

                    <!-- Category Image -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label class="input-label mb-1 fw-medium">Image</label>
                        <input type="file" name="imageAdd" id="imageAdd" class="d-none">
                        <label for="imageAdd" style="cursor:pointer; display: inline-block;">
                            <img src="assets/img/icon/add-image.svg" alt="Upload Image" width="41">
                        </label>
                    </div>

                    <!-- Category Name (Below Image) -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="categoryName" class="input-label mb-1 fw-medium">
                            Category Name
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add category name">
            <i class="fa fa-question-circle"></i>
        </span>
                        </label>
                        <input type="text" id="categoryName" name="categoryName"
                               class="input-field w-100 rounded" placeholder="Placeholder" required>
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
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
                        <select class="input-field w-100 rounded border" id="status" name="status">
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

                    <!-- Display as Popular -->
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="isPopular" name="is_popular" checked>
                            <label class="form-check-label" for="isPopular">
                                Display as popular article
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
