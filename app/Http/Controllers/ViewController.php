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
        $filename = pathinfo($data->filename, PATHINFO_FILENAME);
        // $filePath = "hls/" . $data->short_file . "/playlist_0_800.m3u8";
        // //session()->flush();
        // // Cek apakah URL sudah ada di session
        // if (!session()->has("video_url_{$id}")) {
        //     $hlsUrl = Storage::disk('wasabi')->temporaryUrl(
        //         $filePath,
        //         now()->addMinutes(480) // Expired in 4 hours
        //     );

        //     // Simpan di session
        //     session(["video_url_{$id}" => $hlsUrl]);
        // } else {
        //     $hlsUrl = session("video_url_{$id}");
        // }

        $hlsUrl = 'https://cdn.veenix.xyz/veenix/' . $filename . '/index.m3u8';

        return view('user.stream', compact('data', 'hlsUrl'));
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
