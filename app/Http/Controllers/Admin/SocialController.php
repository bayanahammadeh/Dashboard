<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SocialRequest;
use App\Models\Personal;
use App\Models\Social;

class SocialController extends Controller
{
    public function index()
    {
        return view('admin.social.index');
    }

    public function fetch()
    {
        $personals = Personal::all();
        $socials = Social::with('personal')->get();
        return response()->json([
            'socials' => $socials,
            'personals' => $personals
        ]);
    }

    public function store(SocialRequest $request)
    {
        $validated = $request->validated();

        $social = new Social();
        $social->name = $request->name;
        $social->url = $request->url;
        $social->personal_id = $request->personal;
        $social->save();

        return response()->json([
            'message' => 'your data were saved successfully',
        ]);
    }

    public function edit($id)
    {
        $social = Social::with('personal')->find($id);
        return response()->json([
            'social' => $social
        ]);
    }

    public function update(SocialRequest $request, $id)
    {
        $validated = $request->validated();

        $social = Social::find($id);
        $social->name = $request->name;
        $social->url = $request->url;
        $social->personal_id = $request->personal;
        $social->update();

        return response()->json([
            'message' => 'your data were updated successfully',
        ]);
    }

    public function delete($id)
    {
        $social = Social::find($id);
        if ($social) {
            $social->delete();
            return response()->json([
                'message' => 'Social Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Social Not Found',
            ]);
        }
    }

}
