<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ex;
use App\Models\Experience;
use App\Models\Contact;
use App\Http\Requests\ExRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExController extends Controller
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
        return view('admin.ex.index', compact('role', 'id', 'perm','count'));
    }

    public function fetch()
    {
        $experiences = Experience::all();
        $exs = Ex::with('experience')->get();
        return response()->json([
            'exs' => $exs,
            'experiences' => $experiences,
            'role' => $this->role
        ]);
    }

    public function store(ExRequest $request)
    {
        $validated = $request->validated();

        $ex = new Ex();
        $ex->job_header = $request->header;
        $ex->description = $request->description;
        $ex->experience_id = $request->experience;
        $ex->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $ex = Ex::with('experience')->find($id);
        return response()->json([
            'ex' => $ex
        ]);
    }

    public function update(ExRequest $request, $id)
    {
        $validated = $request->validated();

        $ex = Ex::find($id);
        $ex->job_header = $request->header;
        $ex->description = $request->description;
        $ex->experience_id = $request->experience;
        $ex->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $ex = Ex::find($id);
        if ($ex) {
            $ex->delete();
            return response()->json([
                'message' => 'your data were Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'your data Not Found',
            ]);
        }
    }
}
