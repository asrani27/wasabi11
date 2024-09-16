<?php

namespace App\Console\Commands;

use App\Models\Upload;
use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command {data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encode Video';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = $this->argument('data');
        $ffprobe = FFProbe::create();
        $video = $ffprobe->streams('https://vplayer.veenix.online/storage/' . $data->type . '/' . $data->filename)->videos()->first();
        $res = $video->get('height');

        $BitrateFormat  = (new X264)->setKiloBitrate($res);

        FFMpeg::fromDisk('videos')
            ->open($data->type . '/' . $data->filename)
            ->exportForHLS()
            ->addFormat($BitrateFormat)
            ->toDisk('videos')
            ->save('stream/' . $data->short_file . '/' . $data->short_file . '.m3u8');
    }
}
