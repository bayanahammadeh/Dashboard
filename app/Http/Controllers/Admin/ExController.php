<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ex;
use App\Models\Experience;
use App\Http\Requests\ExRequest;
use Illuminate\Http\Request;

class ExController extends Controller
{
    public function index()
    {
        return view('admin.ex.index');
    }

    public function fetch()
    {
        $experiences = Experience::all();
        $exs = Ex::with('experience')->get();
        return response()->json([
            'exs' => $exs,
            'experiences' => $experiences
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
