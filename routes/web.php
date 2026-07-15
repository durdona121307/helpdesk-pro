<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {

        if (auth()->user()->isAdmin()) {
            return redirect('/admin/dashboard');
        }

        $tickets = Ticket::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('tickets'));

    })->name('dashboard');

    Route::middleware('admin')->group(function () {

        // Admin Dashboard
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

        // Ticket statusini yangilash
        Route::put('/admin/tickets/{ticket}/status', [AdminController::class, 'updateStatus']);

    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Ticket
    Route::get('/tickets/create', [TicketController::class, 'create']);
    Route::post('/tickets', [TicketController::class, 'store']);

    Route::get('/tickets/{ticket}', [TicketController::class, 'show']);

    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit']);
    Route::put('/tickets/{ticket}', [TicketController::class, 'update']);

    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);

    // Comment
    Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store']);

});

require __DIR__.'/auth.php';