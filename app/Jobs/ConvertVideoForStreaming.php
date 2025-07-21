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

            // === Upload ke Wasabi ===
            $localFiles = Storage::disk('public')->files($outputFolder);
            //dd($localFiles);
            foreach ($localFiles as $file) {
                try {
                    $files = Storage::disk('public')->get($file);

                    Storage::disk('wasabi')->put('stream/' . $filename, $files);

                    Log::info("Uploaded: " . $file);
                } catch (\Exception $e) {
                    Log::error("Failed to upload {$file}: " . $e->getMessage());
                }
            }
        } catch (\Exception $e) {
            // Menyimpan error ke log
            dd($e->getMessage());
            throw $e;
        }
    }
}
