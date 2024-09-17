<?php

namespace App\Jobs;

use App\Models\Upload;
use FFMpeg\Format\Video\X264;
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

    public $video;

    public function __construct(Upload $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $BitrateFormat  = (new X264)->setKiloBitrate($this->video->resolusi);

        FFMpeg::fromDisk('videos')
            ->open($this->video->type . '/' . $this->video->filename)
            ->exportForHLS()
            ->addFormat($BitrateFormat)
            ->toDisk('videos')
            ->save('stream/' . $this->video->short_file . '/' . $this->video->short_file . '.m3u8');


        // Storage::disk('wasabi')->put('public/' . $this->file->type . '/' . $this->file->filename, $files);
    }
}
