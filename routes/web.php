<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MeetingRoomController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Models\MeetingRoom;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    // Rotta per tutte le sale meeting
    Route::resource('/rooms', MeetingRoomController::class);
    // Rotta per tutti gli eventi
    Route::resource('/events', EventController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ROTTA API PER LA GESTIONE DELLA DISPONIBILITA' SALE
Route::get('/api/check-availability', function (Request $request) {
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    $availableRooms = MeetingRoom::whereDoesntHave('events', function ($query) use ($startDate, $endDate) {
        $query->whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])
            ->orWhereRaw('? BETWEEN start_date AND end_date', [$startDate])
            ->orWhereRaw('? BETWEEN start_date AND end_date', [$endDate]);
    })->get();

    return response()->json($availableRooms);
});

require __DIR__.'/auth.php';
