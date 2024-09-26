<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketOpened;
use App\Mail\TicketClosed;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {

        $tickets = Ticket::where('status', 'open')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function show($id)
    {

        $ticket = Ticket::findOrFail($id);
        $ticket_replies = TicketReply::where('ticket_id', $id)->get();
        return view('tickets.show', compact('ticket','ticket_replies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'ticket_message' => 'required',
        ]);

        $ticket = new Ticket();
        $ticket->customer_id = auth()->id();
        $ticket->subject = $request->subject;
        $ticket->ticket_message = $request->ticket_message;
        $ticket->status = 'open';
        $ticket->save();

        // Send email notification to admin
        Mail::to('sweetytanha63@gmail.com')->send(new TicketOpened($ticket));

        return redirect()->route('tickets.index')->with('success', 'Ticket has been opened successfully!');
    }

    public function respond(Request $request, $ticketId)
    {
        $reply = new TicketReply();
        $reply->ticket_id = $ticketId;
        $reply->customer_id = auth()->id(); // Admin's ID
        $reply->reply_message = $request->response;
        $reply->save();

        return redirect()->route('tickets.show', $ticketId);
    }

    public function closeTicket($ticketId)
    {
        $ticket = Ticket::find($ticketId);
        $ticket->status = 'closed';
        $ticket->save();

        // Notify customer via email
        // dd($ticket->customer->email);
        Mail::to($ticket->customer->email)->send(new TicketClosed($ticket));

        return redirect()->route('tickets.index');
    }
}