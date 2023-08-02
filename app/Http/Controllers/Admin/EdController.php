<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EdRequest;
use App\Models\Education;
use App\Models\Contact;
use App\Models\Ed;
use Illuminate\Support\Facades\Auth;

class EdController extends Controller
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
        return view('admin.ed.index',compact('role','id','perm','count'));
    }

    public function fetch()
    {
        $educations = Education::all();
        $eds = Ed::with('education')->get();
        return response()->json([
            'eds' => $eds,
            'educations' => $educations,
            'role' => $this->role
        ]);
    }

    public function store(EdRequest $request)
    {
        $validated = $request->validated();

        $ed = new Ed();
        $ed->edu_name = $request->name;
        $ed->detail = $request->detail;
        $ed->education_id = $request->education;
        $ed->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $ed = Ed::with('education')->find($id);
        return response()->json([
            'ed' => $ed
        ]);
    }

    public function update(EdRequest $request, $id)
    {
        $validated = $request->validated();

        $ed = Ed::find($id);
        $ed->edu_name = $request->name;
        $ed->detail = $request->detail;
        $ed->education_id = $request->education;
        $ed->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $ed = Ed::find($id);
        if ($ed) {
            $ed->delete();
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
