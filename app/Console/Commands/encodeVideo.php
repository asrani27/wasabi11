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
        $video4k = $ffprobe->streams('https://videos.pexels.com/video-files/1409899/1409899-uhd_2560_1440_25fps.mp4')->videos()->first();
        $width4k = $video4k->get('width');
        $height4k = $video4k->get('height');

        $video2k = $ffprobe->streams('https://videos.pexels.com/video-files/15966208/15966208-uhd_2560_1440_60fps.mp4')->videos()->first();
        $width2k = $video2k->get('width');
        $height2k = $video2k->get('height');

        $video1080p = $ffprobe->streams('https://download.megaup.net/?idurl=0lixLaV5L89JKamcHXUbegKOGnRGybLeHGQbqUTMIaf5WY+OFKNHoGNF2GRBjTaxcv1EDXcFD7mkM2rhN5RIXzVaM4Q1l3EkI0f+AqZGvMoMhEI2X3RuN6J/OhPLXT6iUJepFl5BQbTn2RzrQRKJ+g==&idfilename=[nunadrama]_No.Gain.No.Love.%20E01.360p.mp4&idfilesize=134.63%20MB')->videos()->first();
        $width1080p = $video1080p->get('width');
        $height1080p = $video1080p->get('height');

        $video720p = $ffprobe->streams('https://download.megaup.net/?idurl=0lixLaV5L89JKamcHXUbegKOGnRGybLeHGQbqUTMIaf5WY+OFKNHoGNF2GRBjTaxcv1EDXcFD7mkM2rhN5RIXzVaM4Q1l3EkI0f+AqZGvMoMhEI2X3RuN6J/OhPLXT6iUJepFl5BQbTn2RzrQRKJ+g==&idfilename=[nunadrama]_No.Gain.No.Love.%20E01.360p.mp4&idfilesize=134.63%20MB')->videos()->first();
        $width720p = $video720p->get('width');
        $height720p = $video720p->get('height');

        $video480p = $ffprobe->streams('https://download.megaup.net/?idurl=0lixLaV5L89JKamcHXUbegKOGnRGybLeHGQbqUTMIaf5WY+OFKNHoGNF2GRBjTaxcv1EDXcFD7mkM2rhN5RIXzVaM4Q1l3EkI0f+AqZGvMoMhEI2X3RuN6J/OhPLXT6iUJepFl5BQbTn2RzrQRKJ+g==&idfilename=[nunadrama]_No.Gain.No.Love.%20E01.360p.mp4&idfilesize=134.63%20MB')->videos()->first();
        $width480p = $video480p->get('width');
        $height480p = $video480p->get('height');

        $video320p = $ffprobe->streams('https://download.megaup.net/?idurl=0lixLaV5L89JKamcHXUbegKOGnRGybLeHGQbqUTMIaf5WY+OFKNHoGNF2GRBjTaxcv1EDXcFD7mkM2rhN5RIXzVaM4Q1l3EkI0f+AqZGvMoMhEI2X3RuN6J/OhPLXT6iUJepFl5BQbTn2RzrQRKJ+g==&idfilename=[nunadrama]_No.Gain.No.Love.%20E01.360p.mp4&idfilesize=134.63%20MB')->videos()->first();
        $width320p = $video320p->get('width');
        $height320p = $video320p->get('height');
        //$bitrate = $video->get('bit_rate');
        dd(
            $width4k,
            $height4k,
            $width2k,
            $height2k,
            $width1080p,
            $height1080p,
            $width720p,
            $height720p,
            $width480p,
            $height480p,
            $width320p,
            $height320p

        );


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
