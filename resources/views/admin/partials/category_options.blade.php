@forelse ($categories as $category)
    <option value="{{ $category->id }}" {{ $category->id === $process_id?'selected':'' }}>
        @php
            for($i = 0; $i < $nth; $i++) {
                echo '---|';
            }
        @endphp
        {{ $category->name }}
    </option>
    @includeWhen(!is_null($category->sub), 'admin.partials.category_options', [
        'categories' => $category->sub,
        'nth' => $nth+1,
        'process_id' => $process_id
    ])
@empty
    
@endforelse