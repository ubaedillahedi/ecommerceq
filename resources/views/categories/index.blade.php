@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h3>Category <small><a href="{{ route('categories.create') }}" class="btn btn-warning btn-sm">New Category</a></small></h3>
            {!! Form::open(['url' => 'categories', 'method' => 'get', 'class' => 'form-inline']) !!}
                <div class="form-group find-field {!! $errors->has('q') ? 'has-error' : '' !!}">
                    {!! Form::text('q', isset($q) ? $q : null, ['class' => 'form-control', 'placeholder' => 'Cari Kategori...']) !!}
                    {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-reset">Reset</a>
            {!! Form::close() !!}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Parent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->parent ? $category->parent->title : '' }}</td>
                            <td>
                                {!! Form::model($category, ['route' => ['categories.destroy', $category], 'method' => 'delete', 'class' => 'form-inline']) !!}
                                    <a href="{{ route('categories.edit', $category->id) }}">Ubah</a>
                                    &nbsp;|&nbsp;
                                    {!! Form::submit('delete', ['class' => 'btn btn-danger btn-sm js-submit-confirm']) !!}
                                {!! Form::close() !!}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->appends(compact('q'))->links() }}
        </div>
    </div>
</div>
@endsection
