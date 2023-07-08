<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EdRequest;
use App\Models\Education;
use App\Models\Ed;

class EdController extends Controller
{
    public function index()
    {
        return view('admin.ed.index');
    }

    public function fetch()
    {
        $educations = Education::all();
        $eds = Ed::with('education')->get();
        return response()->json([
            'eds' => $eds,
            'educations' => $educations
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
