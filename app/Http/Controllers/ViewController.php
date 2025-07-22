<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

        $filePath = "download/" . $data->type . "/" . $data->filename;

        // Cek apakah URL sudah ada di session
        if (!session()->has("video_url_{$id}")) {
            $hlsUrl = Storage::disk('wasabi')->temporaryUrl(
                $filePath,
                now()->addMinutes(480) // Expired in 4 hours
            );

            // Simpan di session
            session(["video_url_{$id}" => $hlsUrl]);
        } else {
            $hlsUrl = session("video_url_{$id}");
        }


        return view('user.stream', compact('data', 'hlsUrl'));
    }
    // public function stream(Request $request, $path)
    // {

    //     $s3 = new S3Client([
    //         'version' => 'latest',
    //         'region' => env('WAS_DEFAULT_REGION'),
    //         'endpoint' => env('WAS_URL'),
    //         'credentials' => [
    //             'key' => env('WAS_ACCESS_KEY_ID'),
    //             'secret' => env('WAS_SECRET_ACCESS_KEY'),
    //         ],
    //     ]);

    //     $bucket = env('WAS_BUCKET');

    //     try {
    //         $object = $s3->getObject([
    //             'Bucket' => $bucket,
    //             'Key'    => 'download/mp4/12b7333eb71b7c5ab6534e1dd4326970.mp4', // contoh: 'download/mp4/video.mp4' atau 'video/index.m3u8'
    //         ]);

    //         $mime = $object['ContentType'] ?? 'application/octet-stream';
    //         dd($object);
    //         return new StreamedResponse(function () use ($object) {
    //             fpassthru($object['Body']->detach());
    //         }, 200, [
    //             'Content-Type' => $mime,
    //             'Content-Length' => $object['ContentLength'],
    //             'Accept-Ranges' => 'bytes',
    //             'Cache-Control' => 'no-cache',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response("❌ Error: " . $e->getMessage(), 404);
    //     }
    // }

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
