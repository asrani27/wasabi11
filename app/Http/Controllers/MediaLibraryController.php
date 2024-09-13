<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
    public function mediaLibrary(Request $request)
    {
        return view('uploader');
    }
}
