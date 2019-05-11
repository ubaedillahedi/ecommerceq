@extends('layouts.app')

@section('content')
    <h1 class="text-center">Hello World</h1>
    <p class="text-center">
        <button class="btn btn-primary" id="clickme"><i class="fa fa-flickr" aria-hidden="true"></i> Button Primary</button>
    </p>
    <p class="text-center">
        <button class="btn btn-success" id="clicksuccess">Button Success <span class="badge badge-secondary">New</span></button>
    </p>
@endsection
