@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <h1 class="display-4">Welcome</h1>
        <p class="lead">This is the welcome page. Replace this content with your application's introduction.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Get Started</a>
    </div>
</div>
@endsection