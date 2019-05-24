<div class="card">
    <img class="card-img-top" src="{{ $product->photo_path }}">
    <div class="card-body">
        <h5 class="card-title">{{ strtoupper($product->name) }}</h5>
        <p>Model : {{ $product->model }}</p>
        <p>Harga : <strong>Rp. {{ number_format($product->price, 2) }}</strong></p>
        <p>
            Category :
            @foreach ($product->categories as $category)
                <span class="badge badge-primary">
                    <i class="fa fa-btn fa-tags"></i>
                    {{ $category->title }}
                </span>
            @endforeach
        </p>
    </div>
</div>
