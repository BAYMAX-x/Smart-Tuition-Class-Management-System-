<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.dashboard', ['active' => 'dashboard'])->name('dashboard');
Route::view('/courses', 'pages.courses', ['active' => 'courses'])->name('courses');
Route::view('/assignments', 'pages.assignments', ['active' => 'assignments'])->name('assignments');
Route::view('/exams', 'pages.exams', ['active' => 'exams'])->name('exams');
Route::view('/progress', 'pages.progress', ['active' => 'progress'])->name('progress');
Route::view('/calendar', 'pages.calendar', ['active' => 'calendar'])->name('calendar');
Route::view('/downloads', 'pages.downloads', ['active' => 'downloads'])->name('downloads');
Route::view('/inbox', 'pages.inbox', ['active' => 'inbox'])->name('inbox');
Route::view('/settings', 'pages.settings', ['active' => 'settings'])->name('settings');
Route::view('/help', 'pages.help', ['active' => 'help'])->name('help');
