<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalRequest;
use App\Models\Personal;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalController extends FileController
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
        return view('admin.personal.index', compact('role', 'id', 'perm','count'));
    }


    public function  fetch()
    {
        $data = Personal::all();

        return response()->json([
            'data' => $data,
            'role' => $this->role
        ]);
    }


    public function edit($id)
    {
        $personal = Personal::find($id);
        return response()->json([
            'personal' => $personal
        ]);
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
            $personal->pdf = app('App\Http\Controllers\Admin\FileController')->uploadFile($file);
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
            app('App\Http\Controllers\Admin\FileController')->deletedFile($personal->pdf);
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
                $personal->pdf = app('App\Http\Controllers\Admin\FileController')->uploadFile($file);
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
