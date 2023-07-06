<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalRequest;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PersonalController extends Controller
{
    public function  fetch()
    {
        $data = Personal::all();
        return response()->json([
            'data' => $data
        ]);
    }

    public function index()
    {
        return view('admin.personal.index');
    }

    public function edit($id)
    {
        $personal = Personal::find($id);
        return response()->json([
            'personal' => $personal
        ]);
    }

    public function deletedFile($file){
        if (File::exists(public_path('assets/pdf/' . $file))) {
            File::delete(public_path('assets/pdf/' . $file));
        }
    }

    public function uploadFile($file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('assets/pdf/', $filename);
        return $filename;
    }

    public function store(PersonalRequest $request)
    {
        $validated = $request->validated();

        $personal = new Personal();
        $personal->email = $request->email;
        $personal->fname = $request->fname;
        $personal->lname = $request->lname;
        $personal->title = $request->title;
        $personal->description = $request->description;
        $personal->mobile = $request->mobile;
        $personal->phone = $request->phone;
        $personal->address = $request->address;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $personal->pdf = $this->uploadFile($file);
        }
        $personal->save();
        return response()->json([
            'message' => 'your data wre saved successfully',
        ]);
    }

    public function delete($id)
    {
        $personal = Personal::find($id);
        if ($personal) {
            $this->deletedFile($personal->pdf);
            $personal->delete();
            return response()->json([
                'message' => 'Personal Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Personal Not Found',
            ]);
        }
    }
    public function update(PersonalRequest $request, $id)
    {
        $personal = Personal::find($id);

        if ($personal) {
            $validated = $request->validated();

            $personal->email = $request->email;
            $personal->fname = $request->fname;
            $personal->lname = $request->lname;
            $personal->title = $request->title;
            $personal->description = $request->description;
            $personal->mobile = $request->mobile;
            $personal->phone = $request->phone;
            $personal->address = $request->address;

            if ($request->hasFile('file')) {
                $this->deletedFile($personal->pdf);
                $file = $request->file('file');
                $personal->pdf = $this->uploadFile($file);
            }
            $personal->update();
            return response()->json([
                'message' => 'your data wre saved successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Personal Not Found',
            ]);
        }
    }
}
