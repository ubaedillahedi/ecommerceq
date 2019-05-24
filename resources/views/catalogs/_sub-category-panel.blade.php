<br>
<ul class="list-group">
    <li class="list-group-item list-group-item-dark">Subkategori untuk {{ $current_category->title }}</li>
    @foreach ($current_category->childs as $category)
        <a href="{{ url('/catalogs?cat=' . $category->id) }}">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $category->title }}
                <span class="badge badge-primary badge-pill">{!! $category->total_products > 0 ? $category->total_products : '' !!}</span>
            </li>
        </a>
    @endforeach
</ul>
