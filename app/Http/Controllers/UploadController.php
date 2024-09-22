<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload()
    {
        return view('upload');
        // $files = Storage::disk('public')->get('cloud.jpg');

        // dd(Storage::disk('s3')->put('/icon/cloud.jpg', $files));
    }
}
