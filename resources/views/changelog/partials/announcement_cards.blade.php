@forelse($announcements as $announcement)
    <div class="p-4 border rounded bg-white shadow-sm">
        <span class="badge 
            {{ $announcement->status == 'active' ? 'status-active' : '' }} 
            {{ $announcement->status == 'draft' ? 'status-draft' : '' }} 
            {{ $announcement->status == 'inactive' ? 'status-inactive' : '' }}">{{ ucfirst($announcement->status) }}</span>
        <h3 class="text-xl font-semibold mt-2 mb-1">{{ $announcement->title }}</h3>
        <p class="text-gray-600 mb-3">{{ $announcement->description }}</p>
        <div class="d-flex align-items-center flex-wrap">
            @if(!empty($announcement->category_names))
                @foreach($announcement->category_names as $cat)
                    <span class="badge bg-white rounded-pill text-dark border me-1">
                        {{ $cat }}
                    </span>
                @endforeach
            @else
                <span class="badge bg-light rounded-pill text-muted border">No Category</span>
            @endif
        </div>
            
    </div>
@empty
    <p class="text-gray-500 text-center">No announcements found.</p>
@endforelse