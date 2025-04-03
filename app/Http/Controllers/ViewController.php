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
        $filePath = "download/" . $data->type . '/' . $data->filename;

        // Cek apakah URL sudah ada di session
        if (!session()->has("video_url_{$id}")) {
            $mp4TemporaryUrl = Storage::disk('wasabi')->temporaryUrl(
                $filePath,
                now()->addMinutes(480) // Expired in 4 hours
            );
            // Simpan di session
            session(["video_url_{$id}" => $mp4TemporaryUrl]);
        } else {
            $mp4TemporaryUrl = session("video_url_{$id}");
        }

        return view('user.stream', compact('data', 'mp4TemporaryUrl'));
    }
    public function player($id)
    {
        $data       =  Upload::where('short_file', $id)->first();
        $mp4TemporaryUrl = Storage::disk('wasabi')->temporaryUrl(
            "download/" . $data->type . '/' . $data->filename,
            now()->addMinutes(480) // Expired after 1 hour
        );
        return view('user.player', compact('data', 'mp4TemporaryUrl'));
    }
    public function stream_mobile($id)
    {
        $data       =  Upload::where('short_file', $id)->first();
        $mp4TemporaryUrl = Storage::disk('wasabi')->temporaryUrl(
            "download/" . $data->type . '/' . $data->filename,
            now()->addMinutes(480) // Expired after 1 hour
        );

        return view('user.stream_mobile', compact('data', 'mp4TemporaryUrl'));
    }
}
