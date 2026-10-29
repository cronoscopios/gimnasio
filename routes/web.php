<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\ScheduledClassController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/tarifas', [MembershipPlanController::class, 'index'])->name('membership-plans.index');
Route::get('/actividades', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/actividades/{activity:slug}', [ActivityController::class, 'show'])->name('activities.show');
Route::get('/horarios', [ScheduledClassController::class, 'index'])->name('scheduled-classes.index');
Route::get('/equipo', [TrainerController::class, 'index'])->name('trainers.index');
Route::get('/preguntas-frecuentes', [FaqController::class, 'index'])->name('faqs.index');
Route::view('/instalaciones', 'pages.facilities')->name('facilities');
Route::view('/sobre-nosotros', 'pages.about')->name('about');
Route::view('/contacto', 'pages.contact')->name('contact');
