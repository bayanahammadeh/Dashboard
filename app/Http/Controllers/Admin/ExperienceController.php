<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ExperienceRequest;
use App\Models\Personal;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        return view('admin.experience.index');
    }

    public function fetch()
    {
        $personals = Personal::all();
        $experiences = Experience::with('personal')->get();
        return response()->json([
            'experiences' => $experiences,
            'personals' => $personals
        ]);
    }

    public function store(ExperienceRequest $request)
    {
        $validated = $request->validated();

        $experience = new Experience();
        $experience->period = $request->period;
        $experience->personal_id = $request->personal;
        $experience->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $experience = Experience::with('personal')->find($id);
        return response()->json([
            'experience' => $experience
        ]);
    }

    public function update(ExperienceRequest $request, $id)
    {
        $validated = $request->validated();

        $experience = Experience::find($id);
        $experience->period = $request->period;
        $experience->personal_id = $request->personal;
        $experience->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $experience = Experience::find($id);
        if ($experience) {
            $experience->delete();
            return response()->json([
                'message' => 'experience Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'experience Not Found',
            ]);
        }
    }
}
