<?php

namespace Bunker\SiteContact\Http\Controllers;

use App\Http\Controllers\Controller;
use Bunker\SiteContact\Mail\TicketMailable;
use Bunker\SiteContact\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(app()->getLocale());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'visitor_name' => 'required|string',
            'visitor_email' => 'required|email',
            'message' => 'required'
        ]);

        Mail::to(config('config.site_contact.site_contact_email_to', 'example@example.com'))->send( new TicketMailable($request->visitor_name, $request->message));
        Ticket::create($request->only(['name', 'email', 'message']));

        return redirect()->back()->with('success', 'We have received your message. Please wait for further response.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('support-ticket::form');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $siteContact)
    {
        // Show individual site contact
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $siteContact)
    {
        // Show form to edit site contact
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $siteContact)
    {
        // Update site contact
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $siteContact)
    {
        // Delete site contact
    }
}
