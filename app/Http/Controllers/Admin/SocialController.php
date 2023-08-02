<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SocialRequest;
use App\Models\Personal;
use App\Models\Social;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    protected $role;
    protected $id;
    protected $perm;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $perm = Auth::user()->role_as;
            $this->id  = Auth::user()->id;
            if ($perm == 1)
                $this->role = "supper";
            if ($perm == 2)
                $this->role = "admin";
            if ($perm == 3)
                $this->role = "user";
            $this->perm = $perm;
            return $next($request);
        });
    }

    public function index()
    {
        $role = $this->role;
        $id = $this->id;
        $perm = $this->perm;
        $notification=Contact::where('status', '=', 0)->get();
        $count = $notification->count();
        return view('admin.social.index', compact('role', 'perm', 'id','count'));
    }

    public function fetch()
    {
        $personals = Personal::all();
        $socials = Social::with('personal')->get();
        return response()->json([
            'socials' => $socials,
            'personals' => $personals,
            'role' => $this->role
        ]);
    }

    public function store(SocialRequest $request)
    {
        $validated = $request->validated();

        $social = new Social();
        $social->name = $request->name;
        $social->url = $request->url;
        $social->personal_id = $request->personal;
        $social->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $social = Social::with('personal')->find($id);
        return response()->json([
            'social' => $social
        ]);
    }

    public function update(SocialRequest $request, $id)
    {
        $validated = $request->validated();

        $social = Social::find($id);
        $social->name = $request->name;
        $social->url = $request->url;
        $social->personal_id = $request->personal;
        $social->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $social = Social::find($id);
        if ($social) {
            $social->delete();
            return response()->json([
                'message' => 'Social Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Social Not Found',
            ]);
        }
    }
}
