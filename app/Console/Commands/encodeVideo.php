<?php

namespace App\Console\Commands;

use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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
        $midBitrateFormat  = (new X264)->setKiloBitrate(720);

        $this->info('Converting sample.mkv');

        FFMpeg::fromDisk('public')
            ->open('storage/mkv/Q.O.T.S01E10.720p.WEB-DL.H264-SEC_a4c01ebbf343076d3b5209292dcf197f.mkv')
            ->exportForHLS()
            ->addFormat($midBitrateFormat)
            ->onProgress(function ($progress) {
                $this->info("Progress: {$progress}");
            })
            ->toDisk('videos')
            ->save('stream/sample/sample.m3u8');
        $this->info('Done');
    }
}
