@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Category</h3>
            {!! Form::open(['url' => 'categories', 'method' => 'get', 'class' => 'form-inline']) !!}
                <div class="form-group find-field {!! $errors->has('q') ? 'has-error' : '' !!}">
                    {!! Form::text('q', isset($q) ? $q : null, ['class' => 'form-control', 'placeholder' => 'Type Category..']) !!}
                    {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Parent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->parent ? $category->parent->title : '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
