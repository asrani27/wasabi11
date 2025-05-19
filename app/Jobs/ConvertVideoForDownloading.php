<?php

namespace App\Jobs;

use App\Models\Upload;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ConvertVideoForDownloading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;

    public function __construct(Upload $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        try {
            $path = $this->file->type . '/' . $this->file->filename;

            if (!Storage::disk('public')->exists($path)) {
                Log::error("File not found: " . $path);
                return;
            }

            $files = Storage::disk('public')->get($path);
            Storage::disk('wasabi')->put('download/' . $path, $files);
            $deleted = Storage::disk('public')->delete($path);
            Log::info('File deletion result: ' . json_encode($deleted));

            $this->file->update([
                'status_download' => 1,
                'status_stream' => 1
            ]);
        } catch (\Throwable $e) {
            Log::error('ConvertVideoForDownloading failed: ' . $e->getMessage());
        }
    }
}
