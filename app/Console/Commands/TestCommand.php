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
        dd($data);
        $ffprobe = FFProbe::create();
        $video = $ffprobe->streams('https://vplayer.veenix.online/storage/' . $this->video->type . '/' . $this->video->filename)->videos()->first();
        $res = $video->get('height');

        $BitrateFormat  = (new X264)->setKiloBitrate($res);

        FFMpeg::fromDisk('videos')
            ->open($this->video->type . '/' . $this->video->filename)
            ->exportForHLS()
            ->addFormat($BitrateFormat)
            ->toDisk('videos')
            ->save('stream/' . $this->video->short_file . '/' . $this->video->short_file . '.m3u8');
    }
}
