<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Ticket::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'open',
        ]);

        return redirect('/dashboard')
            ->with('success', 'Ticket muvaffaqiyatli yaratildi!');
    }

    public function show(Ticket $ticket)
    {
        // Faqat o'z ticketini ko'rish
        if ($ticket->user_id != auth()->id()) {
            abort(403);
        }

        $ticket->load(['comments.user']);

        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        // Faqat o'z ticketini tahrirlash
        if ($ticket->user_id != auth()->id()) {
            abort(403);
        }

        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        // Faqat o'z ticketini yangilash
        if ($ticket->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);

        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect('/tickets/' . $ticket->id)
            ->with('success', 'Ticket muvaffaqiyatli yangilandi!');
    }

    public function destroy(Ticket $ticket)
    {
        // Faqat o'z ticketini o'chirish
        if ($ticket->user_id != auth()->id()) {
            abort(403);
        }

        $ticket->delete();

        return redirect('/dashboard')
            ->with('success', 'Ticket muvaffaqiyatli o‘chirildi!');
    }
}