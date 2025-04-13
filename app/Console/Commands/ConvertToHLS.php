<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class ConvertToHLS extends Command
{
    protected $signature = 'video:convert-hls {filename}';
    protected $description = 'Convert MP4 video to HLS (.m3u8)';

    public function handle()
    {
        $filename = $this->argument('filename'); // contoh: harrypotter.mp4
        $inputPath = public_path("stream/{$filename}");

        if (!file_exists($inputPath)) {
            $this->error("File {$filename} not found in /public/stream/");
            return 1;
        }

        $outputDir = public_path('stream/hls/' . pathinfo($filename, PATHINFO_FILENAME));
        File::ensureDirectoryExists($outputDir);

        $outputPath = $outputDir . '/index.m3u8';

        $ffmpegCmd = "ffmpeg -i \"$inputPath\" -codec: copy -start_number 0 -hls_time 10 -hls_list_size 0 -f hls \"$outputPath\"";

        $this->info("Converting $filename to HLS...");

        exec($ffmpegCmd, $output, $resultCode);

        if ($resultCode === 0) {
            $this->info("Conversion complete. Output saved to: /public/stream/hls/" . pathinfo($filename, PATHINFO_FILENAME));
        } else {
            $this->error("Conversion failed.");
        }

        return $resultCode;
    }
}
