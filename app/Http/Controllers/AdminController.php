<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        $query = Ticket::with('user');

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($user) use ($search) {

                        $user->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");

                  });

            });

        }

        // Filter
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        $tickets = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalTickets = Ticket::count();

        $openTickets = Ticket::where('status','open')->count();

        $inProgressTickets = Ticket::where('status','in_progress')->count();

        $closedTickets = Ticket::where('status','closed')->count();

        $usersCount = User::count();

        return view('admin.dashboard', compact(
            'tickets',
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'closedTickets',
            'usersCount'
        ));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        abort_if(!auth()->user()->isAdmin(),403);

        $request->validate([
            'status'=>'required|in:open,in_progress,closed',
        ]);

        $ticket->update([
            'status'=>$request->status,
        ]);

        return back()->with('success','Ticket statusi muvaffaqiyatli yangilandi.');
    }
}