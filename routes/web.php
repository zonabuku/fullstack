<?php

use App\Http\Livewire\PostMaster;
use Illuminate\Support\Facades\Route;

Route::get('/', PostMaster::class)->name('post.manager');

