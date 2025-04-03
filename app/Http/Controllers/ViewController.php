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

        // $mp4TemporaryUrl = Storage::disk('wasabi')->temporaryUrl(
        //     "download/" . $data->type . '/' . $data->filename,
        //     now()->addMinutes(120) // Expired after 1 hour
        // );
        // $mp4TemporaryUrl = 'https://video-ok.s3.ap-southeast-1.wasabisys.com/download/mp4/94ab479aac55a70877c66026b1e7b90f.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=5IEJZ5C0CVEXZE5K8ITC%2F20250403%2Fap-southeast-1%2Fs3%2Faws4_request&X-Amz-Date=20250403T050041Z&X-Amz-SignedHeaders=host&X-Amz-Expires=28800&X-Amz-Signature=9a89a010ec8972c60788b4f488e0cb43dadff85d25fbf21a45ad85fb7352c43e';
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
