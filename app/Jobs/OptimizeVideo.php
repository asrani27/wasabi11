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

class OptimizeVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0;
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
        FFMpeg::fromDisk('videos')
            ->open($this->video->type . '/' . $this->video->filename)
            ->export()
            ->toDisk('public')
            ->inFormat(new X264('aac', 'libx264'))
            ->addFilter('-movflags', 'faststart')
            ->save('optimize/' . $this->video->short_file . '/' . $this->video->filename);

        $files = Storage::disk('public')->get('optimize/' . $this->video->short_file . '/' . $this->video->filename);

        Storage::disk('s3')->put('optimize/' . $this->video->type . '/' . $this->video->filename, $files);
    }
}
