@php
    $collapseId = 'group' . $category->id;
    $rowClasses = $level > 0 ? "child-row d-none {$parentClass}" : '';
    $sortedChildren = $category->children
        ->sortBy(function ($child) {
            return $child->sort_order == 0 || is_null($child->sort_order) ? PHP_INT_MAX : $child->sort_order;
        });
@endphp

<tr class="level-{{ $level }} {{ $rowClasses }}" data-status="{{ strtolower($category->status ?? '') }}" data-id="{{ $category->id }}">
    <td>
        @if($category->children->count() > 0)
            <button class="expand-btn border-0 bg-transparent" data-group="{{ $collapseId }}">
                <i class="fa fa-plus-circle"></i>
            </button>
        @else
            <i class="fa fa-circle text-muted"></i>
        @endif
    </td>
    <td>
        <span class="d-inline-block ms-{{ $level * 4 }}">
            {{ str_repeat('↳ ', $level) }} {{ $category->name }}
        </span>
    </td>
    <td>
        <span class="d-inline-block ms">
            {{ ucfirst($category->status) }}
        </span>
    </td>
    <td>{{ $category->all_descendants_count }}</td>
    <td>{{ $category->articles->count() ?? 0 }}</td>
    <td>
        <span class="badge bg-white border text-dark tooltip-icon" title="View Articles">
            <a href="#"><img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
        </span>
    </td>
</tr>

@if($sortedChildren->count() > 0)
    @foreach($sortedChildren as $child)
        @include('kbarticle.partials.category_tree', [
            'category' => $child,
            'level' => $level + 1,
            'parentClass' => $collapseId
        ])
    @endforeach
@endif
