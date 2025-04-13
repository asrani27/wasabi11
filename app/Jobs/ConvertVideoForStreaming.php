<?php

namespace App\Jobs;

use App\Models\Upload;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0;
    public $file;

    public function __construct(Upload $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $filename = $this->file->short_file;
            $outputFolder = 'hls/' . $filename;
            Storage::disk('public')->deleteDirectory($outputFolder);

            $BitrateFormat = (new X264)->setKiloBitrate($this->file->resolusi);

            FFMpeg::fromDisk('videos')
                ->open($this->file->type . '/' . $this->file->filename)
                ->exportForHLS()
                ->addFormat($BitrateFormat)
                ->save("{$outputFolder}/playlist.m3u8");
        } catch (\Exception $e) {
            // Menyimpan error ke log
            dd($e->getMessage());

            // Atau kalau kamu ingin melempar ulang agar job dianggap gagal dan bisa retry
            throw $e;
        }




        // $BitrateFormat  = (new X264)->setKiloBitrate($this->video->resolusi);

        // FFMpeg::fromDisk('videos')
        //     ->open($this->video->type . '/' . $this->video->filename)
        //     ->exportForHLS()
        //     ->addFormat($BitrateFormat)
        //     ->setSegmentLength(10)
        //     ->toDisk('videos')
        //     ->save('stream/' . $this->video->short_file . '/' . $this->video->short_file . '.m3u8');

        // $allFiles = Storage::disk('videos')->allFiles('stream/' . $this->video->short_file);

        // foreach ($allFiles as $key => $file) {

        //     $data = Storage::disk('videos')->get($file);

        //     Storage::disk('s3')->put($file, $data);
        // }

        // Storage::disk('public')->deleteDirectory('stream/' . $this->video->short_file);

        // $this->video->update(['status_stream' => 1]);

        // Storage::disk('public')->delete($this->file->type . '/' . $this->file->filename);
    }
}
