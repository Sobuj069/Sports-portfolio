<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'First-name' => 'nullable|string|max:255',
            'first-name' => 'nullable|string|max:255',
            'Last-name' => 'nullable|string|max:255',
            'last-name' => 'nullable|string|max:255',
            'Email' => 'nullable|email|max:255',
            'email' => 'nullable|email|max:255',
            'Message' => 'nullable|string|max:5000',
            'message' => 'nullable|string|max:5000',
        ]);

        $firstName = $request->input('First-name') ?? $request->input('first-name');
        $lastName = $request->input('Last-name') ?? $request->input('last-name');
        $email = $request->input('Email') ?? $request->input('email');
        $message = $request->input('Message') ?? $request->input('message');

        if (! $email || ! $message) {
            return response()->json([
                'success' => false,
                'message' => 'Email and message fields are required.',
            ], 422);
        }

        $contact = Contact::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'message' => $message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been received.',
            'data' => $contact,
        ]);
    }
}
