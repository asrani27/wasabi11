<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\UploadHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class WasabiController extends Controller
{
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
                $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
                $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

                $originalName = $file->getClientOriginalName();

                $disk = Storage::disk('public');
                $path = $disk->putFileAs($extension, $file, $fileName);
                $shortlink = Str::random(10);

                $size = $file->getSize();

                $new = new Upload();
                $new->username = Auth::user()->id;
                $new->original_file = $originalName;
                $new->short_file = $shortlink;
                $new->filename = $fileName;
                $new->size = $size;
                $new->type = $extension;
                $new->save();

                ConvertVideoForStreaming::dispatch($new);

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
}
