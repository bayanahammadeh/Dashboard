<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EducationRequest;
use App\Models\Personal;
use App\Models\Education;


class EducationController extends Controller
{
    public function index()
    {
        return view('admin.education.index');
    }

    public function fetch()
    {
        $personals = Personal::all();
        $educations = Education::with('personal')->get();
        return response()->json([
            'educations' => $educations,
            'personals' => $personals
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
                'message' => 'Education Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Education Not Found',
            ]);
        }
    }
}
