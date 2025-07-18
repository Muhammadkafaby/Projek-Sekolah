<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Setting;
use App\Models\Announcement;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'settings' => Setting::all()->pluck('value', 'key'),
        'announcements' => Announcement::latest()->take(3)->get(),
    ]);
})->name('welcome');

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classes;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'stats' => [
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'classes' => Classes::count(),
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('settings/landing', [SettingController::class, 'landing'])->name('settings.landing');
    Route::post('settings/landing', [SettingController::class, 'updateLanding'])->name('settings.landing.update');
});

require __DIR__.'/auth.php';
