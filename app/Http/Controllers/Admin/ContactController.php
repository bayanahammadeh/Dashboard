<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contact.index');
    }

    public function fetch()
    {
        $contacts = Contact::all();
        return response()->json([
            'contacts' => $contacts
        ]);
    }

    public function update($id)
    {
        $contact = Contact::find($id);
        $contact->status = "1";
        $contact->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }
}
