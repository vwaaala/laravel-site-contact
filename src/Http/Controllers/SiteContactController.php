<?php

namespace Bunker\SiteContact\Http\Controllers;

use App\Http\Controllers\Controller;
use Bunker\SiteContact\Mail\SiteContactMailable;
use Bunker\SiteContact\Models\SiteContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve and display site contacts
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

        Mail::to(config('config.site_contact_email_to', 'example@example.com'))->send( new SiteContactMailable($request->visitor_name, $request->message));
        SiteContact::create($request->only(['visitor_name', 'visitor_email', 'message']));

        return redirect()->back()->with('success', 'We have received your message. Please wait for further response.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('site-contact::form');
    }

    /**
     * Display the specified resource.
     */
    public function show(SiteContact $siteContact)
    {
        // Show individual site contact
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SiteContact $siteContact)
    {
        // Show form to edit site contact
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SiteContact $siteContact)
    {
        // Update site contact
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteContact $siteContact)
    {
        // Delete site contact
    }
}
