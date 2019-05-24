@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                Akan diisi sidebar
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li>Kategori : Semua Kategori</li>
                        </ol>
                    </div>
                    @foreach ($products as $product)
                        <div class="col-md-6">
                            @include('catalogs._product-thumbnail', ['product' => $product])
                        </div>
                    @endforeach
                    <div class="pull-right">
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
