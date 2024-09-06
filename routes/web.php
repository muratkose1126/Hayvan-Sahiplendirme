<?php

use App\Livewire\Home;
use App\Livewire\Pets;
use Illuminate\Support\Facades\Route;


Route::view('dashboard', 'dashboard')
->middleware(['auth', 'verified'])
->name('dashboard');

Route::view('profile', 'profile')
->middleware(['auth'])
->name('profile');

require __DIR__.'/auth.php';

Route::get('/',Home::class);
Route::get('/pets',Pets::class);
