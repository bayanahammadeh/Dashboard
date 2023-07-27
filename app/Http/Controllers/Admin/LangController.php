<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LangRequest;
use App\Models\Personal;
use App\Models\Lang;
use Illuminate\Support\Facades\Auth;

class LangController extends Controller
{
    protected $role;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $perm = Auth::user()->role_as;
            if ($perm == 1)
                $this->role = "supper";
            if ($perm == 2)
                $this->role = "admin";
            if ($perm == 3)
                $this->role = "user";
            return $next($request);
        });
    }

    public function index()
    {
        $role=$this->role;
        return view('admin.lang.index',compact('role'));
    }

    public function fetch()
    {
        $personals = Personal::all();
        $langs = Lang::with('personal')->get();
        return response()->json([
            'langs' => $langs,
            'personals' => $personals,
            'role' => $this->role
        ]);
    }

    public function store(LangRequest $request)
    {
        $validated = $request->validated();

        $lang = new Lang();
        $lang->lang_name = $request->lang;
        $lang->personal_id = $request->personal;
        $lang->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $lang = Lang::with('personal')->find($id);
        return response()->json([
            'lang' => $lang
        ]);
    }

    public function update(LangRequest $request, $id)
    {
        $validated = $request->validated();

        $lang = Lang::find($id);
        $lang->lang_name = $request->lang;
        $lang->personal_id = $request->personal;
        $lang->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $lang = Lang::find($id);
        if ($lang) {
            $lang->delete();
            return response()->json([
                'message' => 'lang Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'lang Not Found',
            ]);
        }
    }

}
