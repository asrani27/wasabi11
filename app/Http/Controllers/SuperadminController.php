<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuperadminController extends Controller
{
    public function home()
    {
        $data = Upload::orderBy('id', 'DESC')->paginate(10);
        $usedStorage = Upload::sum('size') / 1000 / 1000;
        $totalFiles = Upload::count();
        $totalUsers = User::count();
        return view('superadmin.home', compact('data', 'usedStorage', 'totalFiles', 'totalUsers'));
    }
    public function deleteFile($id)
    {
        $data = Upload::find($id);
        Storage::disk('wasabi')->delete('download/' . $data->type . '/' . $data->filename);
        $data->delete();
        return back()->with('success', 'delete success');
    }
}
