<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $tickets = Ticket::with('user')
            ->latest()
            ->get();

        $openTickets = Ticket::where('status', 'open')->count();
        $inProgressTickets = Ticket::where('status', 'in_progress')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();

        return view('admin.dashboard', compact(
            'tickets',
            'openTickets',
            'inProgressTickets',
            'closedTickets'
        ));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect('/admin/dashboard')
            ->with('success', 'Ticket statusi muvaffaqiyatli yangilandi.');
    }
}