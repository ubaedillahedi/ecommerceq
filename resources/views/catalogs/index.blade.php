@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('catalogs._category-panel')

                @if (isset($category) && $category->hasChild())
                    @include('catalogs._sub-category-panel', ['current_category' => $category])
                @endif

                @if (isset($category) && $category->hasParent())
                    @include('catalogs._sub-category-panel', ['current_category' => $category->parent])
                @endif
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        @include('catalogs._breadcumb', ['current_category' => isset($category) ? $category : null])
                    </div>
                    @foreach ($products as $product)
                        <div class="col-md-6">
                            @include('catalogs._product-thumbnail', ['product' => $product])
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right mg-top-30-px">
                            {!! $products->appends(compact('cat'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
