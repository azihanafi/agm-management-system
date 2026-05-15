<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AttendanceScanner;
use App\Livewire\VotingModule;
use App\Livewire\CeoDashboard;
use App\Livewire\MemberRegistration;
use App\Livewire\LoginForm;
use App\Livewire\MemberNomination;

Route::get('/', function () {
    return redirect()->route('attendance.scan');
});

// Auth & Registration
Route::get('/register', MemberRegistration::class)->name('register');
Route::get('/login', LoginForm::class)->name('login');
Route::get('/attendance', AttendanceScanner::class)->name('attendance.scan');
Route::get('/manual-register', \App\Livewire\ManualRegistration::class)->name('manual.register');

Route::match(['get', 'post'], '/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Protected Voting Routes (Require presence via TAC)
Route::middleware(['auth', 'EnsureMemberIsPresent'])->group(function () {
    Route::get('/voting', VotingModule::class)->name('voting.index');
});

// Nomination Routes (Gatekeeper handles internal auth)
Route::get('/nominate', MemberNomination::class)->name('nominate.index');
Route::get('/MemberNomination', function() { return redirect()->route('nominate.index'); });

// Protected Admin/CEO Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', CeoDashboard::class)->name('admin.dashboard');
    
    // Paperwork Management
    Route::get('/paperwork', \App\Livewire\PaperworkManager::class)->name('paperwork.index');
    Route::get('/paperwork/{paperworkId}', \App\Livewire\PaperworkManager::class)->name('paperwork.edit');
    Route::get('/paperwork/{id}/pdf', [\App\Http\Controllers\PaperworkPdfController::class, 'download'])->name('paperwork.pdf');
    Route::get('/paperwork/{id}/preview', [\App\Http\Controllers\PaperworkPdfController::class, 'stream'])->name('paperwork.preview');
});
