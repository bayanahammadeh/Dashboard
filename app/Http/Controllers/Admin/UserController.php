<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Hash;
use App\Http\Requests\UseRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
        return view('admin.user.index', compact('role', 'id','perm','count'));
    }

    public function  fetch()
    {
        $users = User::all();
        $roles = Role::all();
        return response()->json([
            'users' => $users,
            'role' => $this->role,
            'roles' => $roles
        ]);
    }

    public function store(UseRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $request->name;
        $user->role_as = $request->role_as;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $user = User::with('role')->find($id);
        return response()->json([
            'user' => $user
        ]);
    }
    public function profile($id)
    {
        $user = User::with('role')->find($id);
        return response()->json([
            'user' => $user
        ]);
    }

    public function update(UseRequest $request, $id)
    {
        $validated = $request->validated();

        $user = User::find($id);
        $user->name = $request->name;
        $user->role_as = $request->role_as;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }
    public function update_profile(UseRequest $request, $id)
    {
        $validated = $request->validated();

        $user = User::find($id);
        $user->name = $request->name;
        $user->role_as = $request->role_as;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'message' => 'your data were Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'your data Not Found',
            ]);
        }
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
