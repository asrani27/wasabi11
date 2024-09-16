<?php

namespace App\Console\Commands;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;

class encodeVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:encode-video';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // $midBitrateFormat  = (new X264)->setKiloBitrate(720);
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open('http://vplayer.veenix.online/storage/mkv/Q.O.T.S01E10.720p.WEB-DL.H264-SEC_a4c01ebbf343076d3b5209292dcf197f.mkv');

        $outputPath = public_path() . '/stream/sample/sample.m3u8';
        $this->info('Converting sample.mkv');
        $video->hls()->save($outputPath);

        // FFMpeg::fromDisk('public')
        //     ->open('storage/mkv/Q.O.T.S01E10.720p.WEB-DL.H264-SEC_a4c01ebbf343076d3b5209292dcf197f.mkv')
        //     ->exportForHLS()
        //     ->addFormat($midBitrateFormat)
        //     ->onProgress(function ($progress) {
        //         $this->info("Progress: {$progress}");
        //     })
        //     ->toDisk('videos')
        //     ->save('stream/sample/sample.m3u8');
        $this->info('Done');
    }
}
