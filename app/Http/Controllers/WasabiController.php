<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use FFMpeg\Format\Video\X264;
use App\Helpers\UploadHandler;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ConvertVideoForStreaming;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\OptimizeVideo;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class WasabiController extends Controller
{
    public function convert()
    {
        $data = Upload::find('9d053975-4584-451b-8e28-332f59c44ecc');
        ConvertVideoForStreaming::dispatch($data);
    }
    public function upload(Request $request)
    {
        if (Auth::check()) {

            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
            if (!$receiver->isUploaded()) {
                // file not uploaded
            }
            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
                $file = $fileReceived->getFile(); // get file
                $extension = $file->getClientOriginalExtension();
                $fileName = md5($file->getClientOriginalName() . time()) . '.' . $extension; // a unique file name

                $originalName = $file->getClientOriginalName();

                $disk = Storage::disk('public');
                $path = $disk->putFileAs($extension, $file, $fileName);
                $shortlink = Str::random(10);

                if ($extension === 'mp4' || $extension === 'mkv') {
                    $ffprobe = FFProbe::create();
                    $video = $ffprobe->streams('storage/' . $extension . '/' . $fileName)->videos()->first();
                    $res = $video->get('height');
                } else {
                    $res = null;
                }

                $size = $file->getSize();

                $new = new Upload();
                $new->username = Auth::user()->id;
                $new->original_file = $originalName;
                $new->short_file = $shortlink;
                $new->filename = $fileName;
                $new->size = $size;
                $new->type = $extension;
                $new->resolusi = $res;
                $new->save();

                if ($extension === 'mp4' || $extension === 'mkv') {
                    //OptimizeVideo::dispatch($new);
                    ConvertVideoForDownloading::dispatch($new);
                    // ConvertVideoForStreaming::dispatch($new);
                } else {
                    ConvertVideoForDownloading::dispatch($new);
                }

                // delete chunked file
                unlink($file->getPathname());

                return [
                    'path' => asset('storage/' . $path),
                    'filename' => $originalName,
                ];
            }
            // otherwise return percentage informatoin
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true,
            ];
        } else {
            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
            if (!$receiver->isUploaded()) {
                // file not uploaded
            }
            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
                $file = $fileReceived->getFile(); // get file
                $extension = $file->getClientOriginalExtension();
                $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
                $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

                $originalName = $file->getClientOriginalName();

                $size = $file->getSize();
                if (round($size / 1000 / 1000) > 100) {
                    return [
                        'message' => 'Max Upload File Size 100MB',
                        'status' => false,
                    ];
                }

                dd($extension);
                $disk = Storage::disk('public');
                $path = $disk->putFileAs($extension, $file, $fileName);

                $shortlink = Str::random(10);

                $files = Storage::disk('public')->get($extension . '/' . $fileName);

                // Storage::disk('wasabi')->put('download/' . $extension . '/' . $fileName, $files);

                //save data
                $new = new Upload();
                $new->username = 'guest';
                $new->original_file = $originalName;
                $new->short_file = $shortlink;
                $new->filename = $fileName;
                $new->size = $size;
                $new->type = $extension;
                $new->save();

                // delete chunked file
                unlink($file->getPathname());

                return [
                    'path' => asset('views/' . $shortlink),
                    'filename' => $originalName,
                ];
            }
            // otherwise return percentage informatoin
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true,
            ];
        }
    }

    public function download($id)
    {
        $data = Upload::find($id);
        $filename = $data->original_file;
        return redirect(Storage::disk('wasabi')->temporaryUrl(
            "download/" . $data->type . "/" . $data->filename,
            now()->addMinutes(240),
            [
                'ResponseContentDisposition' => 'attachment; filename="' . $filename . '"'
            ]
        ));
    }
}
