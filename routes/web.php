<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/banner', function () {
    return view('banner');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth routes ( when not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// After login redirect target
Route::get('/home', function () {
    return redirect('/');
})->name('home')->middleware('auth');

// Admin / protected routes (admin role only; teacher/student cannot access)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', function () { return redirect()->route('faculty.index'); })->name('admin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/biography', [ProfileController::class, 'biographyEdit'])->name('biography.edit');
    Route::put('/biography', [ProfileController::class, 'biographyUpdate'])->name('biography.update');
    Route::get('/teaching-courses', [ProfileController::class, 'teachingCoursesEdit'])->name('teaching-courses.edit');
    Route::put('/teaching-courses', [ProfileController::class, 'teachingCoursesUpdate'])->name('teaching-courses.update');
    Route::get('/academic-positions', [ProfileController::class, 'academicPositionsEdit'])->name('academic-positions.edit');
    Route::put('/academic-positions', [ProfileController::class, 'academicPositionsUpdate'])->name('academic-positions.update');
    Route::get('/faculty', [Controller::class, 'index'])->name('faculty.index');
    Route::get('/faculty/education', [Controller::class, 'faculty_index'])->name('education.index');
    Route::post('/education/store', [Controller::class, 'faculty_store'])->name('education.store');
    Route::get('/education/{id}/edit', [Controller::class, 'edit'])->name('education.edit');
    Route::put('/education/{id}', [Controller::class, 'update'])->name('education.update');
    Route::delete('/education/{id}', [Controller::class, 'destroy'])->name('education.destroy');
});