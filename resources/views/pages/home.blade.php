@extends('pages.layouts.master')

@section('title', 'Home')

@section('css')
<style>
    .home-banner {
        position: relative;
        background-image: url('/images/bg.jpg');
        background-size: cover;
        background-position: center;
        height: 80vh;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .text-container {
        position: relative;
        font-size: 3rem;
        font-weight: bold;
        line-height: 1.5;
        overflow: visible;
        height: 20rem; 
        /* Adjust the height as needed */
    }

    .text-container span {
        position: relative;
        text-align: center;
        font-size: 3rem;
        font-weight: bold;
        animation: textAnimation 6s infinite;
    }

    .text-container span:nth-child(1) {
        color: cyan;
        animation-delay: 0s;
    }

    .text-container span:nth-child(2) {
        color: yellow;
        animation-delay: 2s;
    }

    .text-container span:nth-child(3) {
        color: blue;
        animation-delay: 4s;
    }

    @keyframes textAnimation {
        0% {
            opacity: 0;
            transform: translateY(100%);
        }

        10% {
            opacity: 1;
            transform: translateY(0);
        }

        30% {
            opacity: 1;
            transform: translateY(0);
        }

        40% {
            opacity: 0;
            transform: translateY(-100%);
        }

        100% {
            opacity: 0;
            transform: translateY(-100%);
        }
    }

    /* Fade-in effect for each text line */
    .text-container span {
        display: inline-block;
        position: relative;
        opacity: 0;
        transform: translateY(100%);
    }

    .text-container span:nth-child(1) {
        animation: textAnimation 6s infinite;
        animation-delay: 0s;
    }

    .text-container span:nth-child(2) {
        animation: textAnimation 6s infinite;
        animation-delay: 2s;
    }

    .text-container span:nth-child(3) {
        animation: textAnimation 6s infinite;
        animation-delay: 4s;
    }
</style>
@endsection

@section('content')
<div class="home-banner">
    <div class="text-container">
        <span>Hello!!!</span>
        <span>Here's a sample project using Laravel 11 for....</span>
        <span>"Quira"</span>
    </div>
</div>
@endsection