<ul class="list-group">
    <li class="list-group-item list-group-item-dark">Lihat per kategori</li>
    <a href="/catalogs">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Semua Produk
            <span class="badge badge-primary badge-pill">{{ App\Product::count() }}</span>
        </li>
    </a>
    @foreach (App\Category::noParent()->get() as $category)
        <a href="{{ url('/catalogs?cat=' . $category->id) }}">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $category->title }}
                <span class="badge badge-primary badge-pill">{!! $category->total_products > 0 ? $category->total_products : '' !!}</span>
            </li>
        </a>
    @endforeach
</ul>
