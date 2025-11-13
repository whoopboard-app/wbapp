@extends('layouts.app')
@section('content')
    <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
        <div class="d-flex justify-content-between mb-2">
            <h4 class="fw-medium font-16">Customize Segmentation Fields</h4>
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-2">
                <a href="{{ route('app.settings') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                    <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                    Back to App Settings
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 view-changelog-details">
                <!-- Add / Edit  -->
                <div class="card p-0 bg-white mb-3">
                    <form action="{{ isset($segmentOption) ? route('segments.update', $segmentOption) : route('segments.store') }}" method="POST" class="form">
                        @csrf
                        @if(isset($segmentOption))
                            @method('PUT')
                        @endif

                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 class="fw-medium mb-0">{{ isset($segmentOption) ? 'Edit Segment Field Data' : 'New Segment Field Data' }}</h4>
                        </div>

                        <div class="content-body px-3">
                            <p class="label color-support fw-medium mt-2">
                                Create and organize User Segmentation Fields according to your Requirements. Makes it easier for users to browse updates by topic or type.
                            </p>

                            <div class="row">
                                <!--  Segment Field -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-input">
                                        <label for="segment-field" class="input-label mb-1 fw-medium">
                                            Segment Field
                                        </label>
                                        <select id="segment-field" name="segment_field_id" class="input-field w-100 rounded" required>
                                            <option value="">Select a Segment Field</option>
                                            @foreach($defaultfields as $field)
                                                <option value="{{ $field->id }}"
                                                    {{ (isset($segmentOption) && $segmentOption->segment_field_id == $field->id) ? 'selected' : '' }}>
                                                    {{ $field->field_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-input">
                                        <label for="segment-option" class="input-label mb-1 fw-medium">
                                            Enter Field Option
                                        </label>
                                        <input type="text" id="segment-option" name="segment_option"
                                               class="input-field w-100 rounded"
                                               placeholder="Enter option name"
                                               value="{{ $segmentOption->option_name ?? old('segment_option') }}">
                                        <p id="option-error" class="text-danger text-sm mt-1 d-none">
                                            Option Already Exists For this Segment Field.
                                        </p>
                                    </div>
                                </div>
                                <!-- Status -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-input">
                                        <label for="status" class="input-label mb-1 fw-medium">
                                            Select Status
                                        </label>
                                        <select id="status" name="status" class="input-field w-100 rounded" required>
                                            <option value="" disabled>Select Status</option>
                                            <option value="1" {{ (isset($segmentOption) && $segmentOption->status == 1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ (isset($segmentOption) && $segmentOption->status == 0) ? 'selected' : '' }}>Inactive</option>
                                            <option value="2" {{ (isset($segmentOption) && $segmentOption->status == 2) ? 'selected' : '' }}>Draft</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer gap15 px-3 d-flex justify-content-start" style="background-color: #FCFCFC;">
                            <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block" style="background-color: #0969da;">
                                {{ isset($segmentOption) ? 'Update Segment Field Data' : 'Add Segment Field Data' }}
                            </button>
                            <a href="{{ route('guide.setup.changelog.category') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="card pt-0 px-0 bg-white mt-3">
                    <div class="d-flex border-title align-items-center justify-content-between px-3">
                        <h4 class="fw-medium mb-0">List of Customized Segment Fields ({{ $tenantfields->count() }})</h4>
                        <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                            <div class="position-relative form-group">
                                <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="Search">
                                <input type="search" name="search" id="categorySearch" placeholder="Search"
                                       value="{{ request('search') }}" class="input-field w-100 rounded ps-5">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="categoryTable" class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Status</th>
                                <th>Field Name</th>
                                <th>Segment Name</th>
                                <th class="w-25">Action</th>
                            </tr>
                            </thead>
                            <tbody id="tag-table-body">
                            @include('app-settings.partials.customizesegment', ['tenantfields' => $tenantfields])
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 py-2">
                        {{ $tenantfields->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JavaScript --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const fieldSelect = document.getElementById('segment-field');
            const optionInput = document.getElementById('segment-option');
            const errorMsg = document.getElementById('option-error');

            optionInput.addEventListener('input', () => {
                const fieldId = fieldSelect.value;
                const optionName = optionInput.value.trim();

                if (!fieldId || optionName.length === 0) {
                    errorMsg.classList.add('d-none');
                    return;
                }

                fetch(`{{ route('segments.checkName') }}?segment_field_id=${fieldId}&option_name=${encodeURIComponent(optionName)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.exists) {
                            errorMsg.classList.remove('d-none');
                        } else {
                            errorMsg.classList.add('d-none');
                        }
                    });
            });
        });
    </script>
@endsection
