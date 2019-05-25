<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
    {!! Form::label('parent_id', 'Parent') !!}
    @php
        $field = Form::select('parent_id', ['Pilih Kategori' => 'Pilih Kategori']+App\Category::pluck('title', 'id')->all(), null, ['class' => 'form-control'])
    @endphp
    {!! str_replace('value="Pilih Kategori"', 'value="Pilih Kategori" disabled', $field) !!}
    {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
</div>

{!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
