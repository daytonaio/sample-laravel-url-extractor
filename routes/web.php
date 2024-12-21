<?php

use Illuminate\Support\Facades\Route;

// Default Welcome Page (optional, can be removed if using the Home page as the main entry)
Route::get('/', function () {
    return view('pages.home'); // Replace 'welcome' with 'home' to use the new Home Page
})->name('home');

// URL Link Routes
Route::get('url-link/create', [\App\Http\Controllers\LinkGeneratorController::class, 'create'])->name('url-link.create');
Route::post('url-link/store', [\App\Http\Controllers\LinkGeneratorController::class, 'store'])->name('url-link.store');
Route::get('url-link/list', [\App\Http\Controllers\LinkGeneratorController::class, 'index'])->name('url-link.list');
Route::delete('/url-link/delete/{id}', [\App\Http\Controllers\LinkGeneratorController::class, 'destroy'])->name('url-link.destroy');
Route::put('/url-link/update/{id}', [\App\Http\Controllers\LinkGeneratorController::class, 'update'])->name('url-link.update');

// Contact Page Routes
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    // Validate and process the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Example: Save to database or send an email
    return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
})->name('contact.submit');
