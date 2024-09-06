<?php

use App\Livewire\Home;
use App\Livewire\Pet;
use App\Livewire\Pets;
use Illuminate\Support\Facades\Route;


Route::view('dashboard', 'dashboard')
->middleware(['auth', 'verified'])
->name('dashboard');

Route::view('profile', 'profile')
->middleware(['auth'])
->name('profile');

require __DIR__.'/auth.php';

Route::get('/',Home::class)->name('home');
Route::get('/pets',Pets::class)->name('pets');
Route::get('/pet/{pet}',Pet::class)->name('pet');
