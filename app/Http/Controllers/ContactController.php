<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Show contact form
    public function create()
    {
        return view('contact');
    }

    // Store contact message
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000'
        ]);

        Contact::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => false
        ]);

        return redirect()->back()->with('success', 'Thank you for contacting us! We will respond to your message soon.');
    }

    // Admin: View all contacts
    public function index()
    {
        $unread = Contact::with('user')->where('is_read', false)->latest()->get();
        $read = Contact::with('user')->where('is_read', true)->latest()->get();
        
        return view('admin.contacts.index', compact('unread', 'read'));
    }

    // Admin: Show contact details and reply form
    public function show($id)
    {
        $contact = Contact::with('user')->findOrFail($id);
        
        // Mark as read
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    // Admin: Reply to contact
    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:1000'
        ]);

        $contact = Contact::findOrFail($id);
        
        $contact->update([
            'admin_reply' => $request->admin_reply,
            'replied_at' => now()
        ]);

        // Create notification for user with contact_id reference
        Notification::create([
            'user_id' => $contact->user_id,
            'contact_id' => $contact->id,
            'type' => 'contact_reply',
            'title' => 'Response to your message',
            'message' => 'Admin has replied to your contact message: "' . $contact->subject . '"',
            'is_read' => false
        ]);

        return redirect()->route('admin.contacts.index')->with('success', 'Reply sent successfully! User has been notified.');
    }

    // Admin: Delete contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact message deleted successfully!');
    }
}
