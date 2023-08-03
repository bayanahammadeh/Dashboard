<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EducationRequest;
use App\Models\Personal;
use App\Models\Education;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
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
        return view('admin.education.index', compact('role', 'id', 'perm','count'));
    }

    public function fetch()
    {
        $personals = Personal::all();
        $educations = Education::with('personal')->get();
        return response()->json([
            'educations' => $educations,
            'personals' => $personals,
            'role' => $this->role
        ]);
    }

    public function store(EducationRequest $request)
    {
        $validated = $request->validated();

        $education = new Education();
        $education->education_name = $request->education_name;
        $education->personal_id = $request->personal;
        $education->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $education = Education::with('personal')->find($id);
        return response()->json([
            'education' => $education
        ]);
    }

    public function update(EducationRequest $request, $id)
    {
        $validated = $request->validated();

        $education = Education::find($id);
        $education->education_name = $request->education_name;
        $education->personal_id = $request->personal;
        $education->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $education = Education::find($id);
        if ($education) {
            $education->delete();
            return response()->json([
                'message' => 'your data were deleted successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'your data does not exist',
            ]);
        }
    }
}
