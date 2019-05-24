@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Product <small><a href="{{ route('products.create') }}" class="btn btn-warning btn-sm">New Product</a></small></h3>
                {!! Form::open(['url' => 'products', 'method' => 'get', 'class' => 'form-inline']) !!}
                    <div class="form-group find-field {!! $errors->has('q') ? 'has-error' : '' !!}">
                        {!! Form::text('q', isset($q) ? $q : null, ['class' => 'form-control', 'placeholder' => 'Cari Produk...']) !!}
                        {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                    </div>
                    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-reset">Reset</a>
                {!! Form::close() !!}
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->model }}</td>
                                <td>
                                    @foreach ($product->categories as $category)
                                        <span class="badge badge-primary">
                                            <i class="fa fa-btn fa-tags"></i>{{ $category->title }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    {!! Form::model($product, ['route' => ['products.destroy', $category], 'method' => 'delete', 'class' => 'form-inline']) !!}
                                        <a href="{{ route('products.edit', $product->id) }}">Ubah</a>
                                        &nbsp;|&nbsp;
                                        {!! Form::submit('delete', ['class' => 'btn btn-danger btn-sm js-submit-confirmation']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->appends(compact('q'))->links() }}
            </div>
        </div>
    </div>
@endsection
