<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Personal;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
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
        return view('admin.skill.index', compact('role', 'perm', 'id','count'));
    }

    public function fetch()
    {
        $personals = Personal::all();
        $skills = Skill::with('personal')->get();
        return response()->json([
            'skills' => $skills,
            'personals' => $personals,
            'role' => $this->role
        ]);
    }

    public function store(SkillRequest $request)
    {
        $validated = $request->validated();

        $skill = new Skill();
        $skill->skill_name = $request->name;
        $skill->percentage = $request->percentage;
        $skill->personal_id = $request->personal;

        $skill->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $skill = Skill::with('personal')->find($id);
        return response()->json([
            'skill' => $skill
        ]);
    }

    public function update(SkillRequest $request, $id)
    {
        $validated = $request->validated();

        $skill = Skill::find($id);

        $skill->skill_name = $request->name;
        $skill->percentage = $request->percentage;
        $skill->personal_id = $request->personal;

        //var_dump($skill);
        $skill->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $skill = Skill::find($id);
        if ($skill) {
            $skill->delete();
            return response()->json([
                'message' => 'Skill Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Skill Not Found',
            ]);
        }
    }
}
