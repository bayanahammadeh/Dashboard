<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Personal;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;


class ProjectController extends ImageController
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
        return view('admin.project.index', compact('role', 'perm', 'id','count'));
    }

    public function fetch()
    {
        $personals = Personal::all();
        $projects = Project::with('personal')->get();
        return response()->json([
            'projects' => $projects,
            'personals' => $personals,
            'role' => $this->role
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
        $project = new Project();
        $project->project_name = $request->project_name;
        $project->project_url = $request->project_url;
        $project->personal_id = $request->personal;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $project->project_image = app('App\Http\Controllers\Admin\ImageController')->uploadFile($file);
        }
        $project->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $project = Project::with('personal')->find($id);
        return response()->json([
            'project' => $project
        ]);
    }

    public function update(ProjectRequest $request, $id)
    {
        $validated = $request->validated();

        $project = Project::find($id);

        $project->project_name = $request->project_name;
        $project->project_url = $request->project_url;
        $project->personal_id = $request->personal;


        if ($request->hasFile('file')) {
            $this->deletedFile($project->project_image);
            $file = $request->file('file');
            $project->project_image = app('App\Http\Controllers\Admin\ImageController')->uploadFile($file);
        }

        $project->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $project = Project::find($id);
        if ($project) {
            app('App\Http\Controllers\Admin\ImageController')->deletedFile($project->project_image);
            $project->delete();
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
