<?php

namespace Bunker\SupportTicket\Http\Controllers;

use App\Http\Controllers\Controller;
use Bunker\SupportTicket\Mail\TicketMailable;
use Bunker\SupportTicket\Models\Reply;
use Bunker\SupportTicket\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:support_ticket_show|support_ticket_create|support_ticket_edit|support_ticket_delete', ['only' => ['index','show']]);
        $this->middleware('permission:support_ticket_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:support_ticket_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $tickets = Ticket::paginate(10);
        return view('support-ticket::index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('support-ticket::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['name' => 'required|string', 'email' => 'required|email', 'message' => 'required']);

        Mail::to(config('config.support_ticket.email_to', 'example@example.com'))->send(new TicketMailable($request->name, $request->message));
        Ticket::create($request->all());

        return redirect()->back()->with('success', 'We have received your message. Please wait for further response.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        // Show individual ticket
        $supportTicket = Ticket::where('uuid', $uuid)->first();
        return view('support-ticket::show', compact('supportTicket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $int)
    {
        // Show form to edit ticket
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $int)
    {
        // Update ticket
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $int)
    {
        // Delete ticket
    }

    public function postReply(Request $request)
    {
        $validator = Validator::make($request->all(), ['reply' => 'required|string']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find the ticket based on the provided UUID
        $ticket = Ticket::where('uuid', $request->input('ticket'))->first();


        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket not found.');
        }

        if (!$ticket->status) {
            return redirect()->back()->with('error', 'You cannot reply to a closed ticket.');
        }

        $ticketReply = Reply::create([
            'uuid' => str()->uuid(),
            'ticket_id' => $ticket->id,
            'replied_user_id' => auth()->user()->id,
            'reply' => $request->input('reply')
        ]);

        return $ticketReply
            ? redirect()->back()->with('success', 'Reply posted successfully.')
            : redirect()->back()->with('error', 'Failed to reply.');
    }

    public function closeReply(string $uuid): RedirectResponse
    {
        $ticket = Ticket::where('uuid', $uuid)->first();

        if ($ticket && $ticket->status) {
            $ticket->status = false;

            if ($ticket->save()) {
                return redirect()->back()->with('success', 'Ticket closed');
            }

            return redirect()->back()->with('error', 'Failed to close ticket');
        }

        return redirect()->back()->with('error', 'Ticket not found or already closed');
    }
    public function reOpenReply(string $uuid): RedirectResponse
    {
        $ticket = Ticket::where('uuid', $uuid)->first();

        if ($ticket && !$ticket->status) {
            $ticket->status = true;

            if ($ticket->save()) {
                return redirect()->back()->with('success', 'The ticket has been reopened');
            }

            return redirect()->back()->with('error', 'Failed to open ticket again');
        }

        return redirect()->back()->with('error', 'Ticket not found or already opened');
    }

}
