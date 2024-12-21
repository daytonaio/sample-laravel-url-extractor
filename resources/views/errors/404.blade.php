@extends('pages.layouts.master')

@section('title', '404 - Page Not Found')

@section('css')
<style>
    .error-page {
        text-align: center;
        padding: 50px;
        font-size: 1.5rem;
    }
    .error-page h1 {
        font-size: 5rem;
        color: #ff4d4d;
    }
    .error-page p {
        margin-top: 20px;
        color: #333;
    }
    .error-page a {
        display: inline-block;
        margin-top: 20px;
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
    }
    .error-page a:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="error-page">
    <h1>404</h1>
    <h4>Oopsies!, the page you're looking for doesn't exist 😛</h4>
    <h6>But you can always checkout what we have, right? </h6>
    <a href="{{ route('home') }}">Wanna checkout?</a>
    <div>

    </div>
</div>
@endsection
