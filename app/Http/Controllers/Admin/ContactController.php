<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * List all submitted inquiries.
     */
    public function index(): View
    {
        $contacts = Contact::latest()->paginate(15);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Delete an inquiry.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}
