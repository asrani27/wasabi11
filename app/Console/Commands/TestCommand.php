<?php

namespace App\Console\Commands;

use App\Models\Upload;
use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

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
        $lowBitrateFormat  = (new X264)->setKiloBitrate(480);
        $midBitrateFormat  = (new X264)->setKiloBitrate(720);
        $highBitrateFormat = (new X264)->setKiloBitrate(1080);

        $this->info('Converting sample.mp4');

        FFMpeg::fromDisk('public')
            ->open('mp4/SampleVideo_1280x720_30mb_5a4c772c3c799d932a0fe92f71a1e561.mp4')
            ->exportForHLS()
            ->addFormat($lowBitrateFormat)
            ->addFormat($midBitrateFormat)
            ->addFormat($highBitrateFormat)
            ->onProgress(function ($progress) {
                $this->info("Progress: {$progress}");
            })
            ->toDisk('videos')
            ->save('stream/sample/sample.m3u8');
    }
}
