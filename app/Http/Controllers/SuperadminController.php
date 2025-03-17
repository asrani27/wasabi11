<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function home()
    {
        $data = Upload::orderBy('id', 'DESC')->paginate(10);
        $usedStorage = Upload::sum('size') / 1000 / 1000;
        $totalFiles = Upload::count();
        return view('superadmin.home', compact('data', 'usedStorage', 'totalFiles'));
    }
}
