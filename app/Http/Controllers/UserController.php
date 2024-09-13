<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home()
    {
        $data = Upload::where('username', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        $usedStorage = Upload::where('username', Auth::user()->id)->sum('size') / 1000 / 1000;
        $totalFiles = Upload::where('username', Auth::user()->id)->count();
        return view('user.home', compact('data', 'usedStorage', 'totalFiles'));
    }

    public function deleteFile($id)
    {
        $data = Upload::find($id);
        Storage::disk('public')->delete($data->type . '/' . $data->filename);
        $data->delete();
        return back()->with('success', 'upload success');
    }
}
