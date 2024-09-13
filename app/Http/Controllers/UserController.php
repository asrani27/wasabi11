<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        $data = Upload::where('username', Auth::user()->id)->paginate(2);
        return view('user.home', compact('data'));
    }

    public function deleteFile($id)
    {
        $data = Upload::find($id);
        return back();
    }
}
