<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
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
        return view('admin.role.index', compact('role', 'perm', 'id'));
    }

    public function fetch()
    {
        $roles = Role::all();
        return response()->json([
            'roles' => $roles,
            'role' => $this->role
        ]);
    }

    public function store(RoleRequest $request)
    {
        $validated = $request->validated();

        $role = new Role();
        $role->role_name = $request->name;
        $role->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return response()->json([
            'role' => $role
        ]);
    }

    public function update(RoleRequest $request, $id)
    {
        $validated = $request->validated();

        $role = Role::find($id);
        $role->role_name = $request->name;
        $role->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
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
