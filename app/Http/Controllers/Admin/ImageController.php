<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function deletedFile($file){
        if (File::exists(public_path('assets/img/' . $file))) {
            File::delete(public_path('assets/img/' . $file));
        }
    }

    public function uploadFile($file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('assets/img/', $filename);
        return $filename;
    }

}
