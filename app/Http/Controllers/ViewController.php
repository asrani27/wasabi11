<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    public function view($id)
    {
        //Storage::disk('stream')->url($video->id . '.m3u8');

        if (Auth::check()) {
            $update_views = Upload::where('short_file', $id)->first();
            $update_views->views = $update_views->views + 1;
            $update_views->save();
            $data = Upload::where('short_file', $id)->first();
            return view('user.view', compact('data'));
        } else {
            $update_views = Upload::where('short_file', $id)->first();
            $update_views->views = $update_views->views + 1;
            $update_views->save();
            $data = Upload::where('short_file', $id)->first();
            return view('view', compact('data'));
        }
    }
    public function stream($id)
    {
        $data       =  Upload::where('short_file', $id)->first();
        $mp4TemporaryUrl = Storage::disk('wasabi')->temporaryUrl(
            "download/" . $data->type . '/' . $data->filename,
            now()->addMinutes(240) // Expired after 1 hour
        );
        //$public     =  Storage::disk('public')->url("stream/" . $data->short_file . "/" . $data->short_file . "_0_" . $data->resolusi . ".m3u8");
        return view('user.stream', compact('data', 'mp4TemporaryUrl'));
    }
}
