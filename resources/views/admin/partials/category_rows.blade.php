@forelse ($categories as $category)
<div class="item-menu">
    <span>
        @php
            for($i = 0; $i < $nth; $i++) {
                echo '---|';
            }
        @endphp
        {{ $category->name }}
    </span>
    <div class="category-fix">
        <a class="btn-category btn-primary" href="{{ route('admin.categories.edit', $category->id) }}"><i class="fa fa-edit"></i></a>
        <a class="btn-category btn-danger btn-delete" data-id="{{ $category->id }}" href="#"><i class="fas fa-times"></i></i></a>

    </div>
</div>
@includeWhen(!is_null($category->sub), 'admin.partials.category_rows', [
    'categories' => $category->sub,
    'nth' => $nth+1
])
@empty
<h4>{{ $nth===0?'Không tồn tại bản ghi nào':'' }}</h4>
@endforelse