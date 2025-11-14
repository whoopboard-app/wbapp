<!-- Dynamic Category Modal -->
<div class="modal fade" id="{{ $modalId ?? 'editParentModal' }}" tabindex="-1" aria-labelledby="{{ $modalId ?? 'editParentModal' }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="{{ $modalId ?? 'editParentModal' }}Label">
                    {{ $isSubCategory ? 'Reorder Sub Categories' : 'Reorder Parent Categories' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" class="d-flex flex-column gap-3">

                    <div class="row">
                        {{-- Parent Category Select --}}
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label for="parentCategory" class="input-label mb-1 fw-medium">
                                    Select Parent Category
                                </label>
                                <select class="form-select w-100 rounded"
                                        id="parentCategory_{{ $modalId }}"
                                    {{ $isSubCategory ? '' : 'disabled' }}>
                                    <option value="">Select</option>
                                    @foreach($kbcategories->where('parent_id', null) as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Sub Category Select --}}
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label for="subCategory" class="input-label mb-1 fw-medium">
                                    Select Sub Category
                                </label>
                                <select class="form-select w-100 rounded"
                                        id="subCategory_{{ $modalId }}"
                                    {{ $isSubCategory ? '' : 'disabled' }}>
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <p class="label fw-medium color-support pt-2">
                        {{ $isSubCategory ? 'List of Sub Categories for Sorting' : 'List of Parent Categories for Sorting' }}
                    </p>

                    {{-- Sortable container --}}
                    <div id="sortable-container-{{ $modalId }}">
                        @foreach($isSubCategory ? $kbcategories->where('parent_id', '!=', null) : $kbcategories->where('parent_id', null) as $category)
                            <div class="mb-3 bg-white kb-card cursor-grab border" data-id="{{ $category->id }}" data-parent="{{ $category->parent_id }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">{{ $category->name }}</h5>
                                            <span class="card-text label">{{ $category->total_articles_count ?? 0 }} Articles</span>
                                        </div>
                                        <div>
                                            <a href="#" class="cursor-grab">
                                                <img src="{{ asset('assets/img/icon/transfer.svg') }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-start border-top-0 py-2 px-4">
                <button type="button" id="saveOrder_{{ $modalId }}" class="theme-btn fw-semibold rounded border-0">Save</button>
                <button type="button" class="theme-btn secondary bg-white fw-semibold rounded" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const allCategories = @json($kbcategories->values());

        function initSortable(modalId) {
            const container = document.getElementById(`sortable-container-${modalId}`);
            if (container && !container.classList.contains('sortable-initialized')) {
                new Sortable(container, {
                    animation: 150,
                    handle: '.cursor-grab',
                    ghostClass: 'drag-ghost'
                });
                container.classList.add('sortable-initialized');
            }
        }

        function handleSave(modalId) {
            const saveBtn = document.getElementById(`saveOrder_${modalId}`);
            const modalEl = document.getElementById(modalId);
            let showToastAfterHide = false; // flag

            if (!modalEl.dataset.listenerAttached) {
                modalEl.addEventListener('hidden.bs.modal', function () {
                    if (showToastAfterHide) {
                        showAlert('success', 'Parent categories reordered successfully!');
                        setTimeout(() => window.location.reload(), 1500);
                        showToastAfterHide = false;
                    }
                });
                modalEl.dataset.listenerAttached = 'true';
            }
            saveBtn.addEventListener('click', function () {
                const container = document.getElementById(`sortable-container-${modalId}`);
                const order = Array.from(container.querySelectorAll('.kb-card'))
                    .map((el, idx) => ({ id: el.dataset.id, position: idx + 1 }));

                fetch('{{ route("categories.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToastAfterHide = true;
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            modal.hide();
                        } else {
                            showAlert('error', data.message || 'Something went wrong!');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showAlert('error', 'An error occurred!');
                    });
            });
        }


        // Recursive helper
        function getAllDescendants(categories, parentId) {
            let descendants = [];

            categories
                .filter(cat => cat.parent_id == parentId)
                .forEach(cat => {
                    descendants.push(cat);
                    descendants = descendants.concat(getAllDescendants(categories, cat.id));
                });

            return descendants;
        }

        // Handle subcategory filtering
        const parentSelect = document.getElementById('parentCategory_editSubModal');
        const subSelect = document.getElementById('subCategory_editSubModal');

        if (parentSelect && subSelect) {
            // When a parent is selected
            parentSelect.addEventListener('change', function () {
                const parentId = this.value;
                subSelect.innerHTML = '<option value="">Select</option>';

                if (!parentId) {
                    renderSortableList([]);
                    return;
                }

                const firstLevelChildren = allCategories.filter(cat => cat.parent_id == parentId);
                firstLevelChildren.forEach(cat => {
                    const opt = document.createElement('option');
                    opt.value = cat.id;
                    opt.textContent = cat.name;
                    subSelect.appendChild(opt);
                });

                renderSortableList(firstLevelChildren);
            });

            // When a subcategory is selected (show deeper descendants)
            subSelect.addEventListener('change', function () {
                const subId = this.value;

                if (!subId) {
                    renderSortableList([]);
                    return;
                }

                const subDescendants = getAllDescendants(allCategories, subId);
                renderSortableList(subDescendants);
            });
        }

        function renderSortableList(categories) {
            const container = document.getElementById('sortable-container-editSubModal');
            container.innerHTML = '';

            if (!categories.length) {
                container.innerHTML = '<p class="text-muted">No subcategories found for this parent.</p>';
                return;
            }

            categories.forEach(category => {
                const card = document.createElement('div');
                card.className = 'mb-3 bg-white kb-card cursor-grab border';
                card.dataset.id = category.id;
                card.dataset.parent = category.parent_id;

                card.innerHTML = `
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1">${category.name}</h5>
                            <span class="card-text label">${category.total_articles_count || 0} Articles</span>
                        </div>
                        <div>
                            <a href="#" class="cursor-grab">
                                <img src="{{ asset('assets/img/icon/transfer.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            `;
                container.appendChild(card);
            });

            new Sortable(container, {
                animation: 150,
                handle: '.cursor-grab',
                ghostClass: 'drag-ghost'
            });
        }
        ['editParentModal', 'editSubModal'].forEach(id => {
            const modalEl = document.getElementById(id);
            modalEl.addEventListener('shown.bs.modal', () => initSortable(id));
            handleSave(id);
        });
    });
</script>




