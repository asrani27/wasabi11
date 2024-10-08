<?php

namespace App\Jobs;

use App\Models\Upload;
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

        $files = Storage::disk('public')->get($this->file->type . '/' . $this->file->filename);

        Storage::disk('wasabi')->put('download/' . $this->file->type . '/' . $this->file->filename, $files);

        Storage::disk('public')->delete($this->file->type . '/' . $this->file->filename);
        $this->file->update([
            'status_download' => 1,
            'status_stream' => 1
        ]);
    }
}
