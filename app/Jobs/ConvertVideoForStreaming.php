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

        $lowBitrateFormat  = (new X264)->setKiloBitrate(480);
        $midBitrateFormat  = (new X264)->setKiloBitrate(720);
        $highBitrateFormat = (new X264)->setKiloBitrate(1080);

        $path = Storage::disk('public')->get($this->video->type . '/' . $this->video->filename);
        dd($path);
        FFMpeg::fromDisk('public')
            ->open('steve_howe.mp4')
            ->exportForHLS()
            ->addFormat($lowBitrateFormat)
            ->addFormat($midBitrateFormat)
            ->addFormat($highBitrateFormat)
            ->save('adaptive_steve.m3u8');
    }
}
