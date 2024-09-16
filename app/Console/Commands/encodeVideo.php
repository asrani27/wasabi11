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

        $ffprobe = FFProbe::create();
        $video = $ffprobe->streams('https://vplayer.veenix.online/uploads/sample.mp4')->videos()->first();
        $width = $video->get('width');
        $height = $video->get('height');
        $bitrate = $video->get('bit_rate');
        $this->info('Informasi sample.mp4');
        $this->info($width, $height, $bitrate);

        // $lowBitrateFormat  = (new X264)->setKiloBitrate(480);
        // $midBitrateFormat  = (new X264)->setKiloBitrate(720);
        // $highBitrateFormat = (new X264)->setKiloBitrate(1080);

        // $this->info('Converting sample.mp4');

        // FFMpeg::fromDisk('public')
        //     ->open('mp4/silaban_09a8efec835d11aee86b6ebb5fbfb9c3.mp4')
        //     ->exportForHLS()
        //     ->addFormat($lowBitrateFormat)
        //     ->addFormat($midBitrateFormat)
        //     ->addFormat($highBitrateFormat)
        //     ->onProgress(function ($progress) {
        //         $this->info("Progress: {$progress}");
        //     })
        //     ->toDisk('stream')
        //     ->save('sample.m3u8');
        // $this->info('Done');
    }
}
