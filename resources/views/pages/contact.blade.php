@extends('pages.layouts.master')

@section('title', 'Contact Us')

@section('content')
<div class="card mx-auto" style="max-width: 600px; margin-top: 50px;">
    <div class="card-header bg-dark text-white">
        <h4>Contact Us</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-dark">Send Message</button>
        </form>
    </div>
</div>
@endsection
