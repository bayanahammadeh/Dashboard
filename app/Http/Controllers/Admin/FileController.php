<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
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

}
