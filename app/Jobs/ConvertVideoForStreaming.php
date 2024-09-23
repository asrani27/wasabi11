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
            ->setSegmentLength(10)
            ->toDisk('videos')
            ->save('stream/' . $this->video->short_file . '/' . $this->video->short_file . '.m3u8');

        $allFiles = Storage::disk('videos')->allFiles('stream/' . $this->video->short_file);
        //dd($allFiles);
        foreach ($allFiles as $key => $file) {

            $data = Storage::disk('videos')->get($file);

            Storage::disk('s3')->put($file, $data);
        }

        Storage::disk('public')->deleteDirectory('stream/' . $this->video->short_file);

        $this->video->update(['status_stream' => 1]);
        //delete di local]
        Storage::disk('public')->delete($this->file->type . '/' . $this->file->filename);
    }
}
