<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        return view('admin.skill.index');
    }

    public function fetch()
    {
        $skills = Skill::with('personal')->get();
        return response()->json([
            'skills' => $skills
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
        $skill = Skill::find($id);
        return response()->json([
            'skill' => $skill
        ]);
    }

    public function update(SkillRequest $request,$id)
    {
        $validated = $request->validated();

        $skill = Skill::find($id);
        $skill->skill_name = $request->name;
        $skill->percentage = $request->percentage;
        $skill->personal_id = $request->personal;
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
                'status' => 200,
                'message' => 'Skill Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Skill Not Found',
            ]);
        }
    }
}
