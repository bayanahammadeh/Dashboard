<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    protected $role;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $perm = Auth::user()->role_as;
            if ($perm == 1)
                $this->role = "supper";
            if ($perm == 2)
                $this->role = "admin";
            if ($perm == 3)
                $this->role = "user";
            return $next($request);
        });
    }

    public function index()
    {
        $role=$this->role;
        return view('admin.contact.index',compact('role'));
    }

    public function fetch()
    {
        $contacts = Contact::all();
        return response()->json([
            'contacts' => $contacts,
            'role' => $this->role
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
