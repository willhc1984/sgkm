<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearTempImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-temp-images';

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
        $files = Storage::disk('public')->files('temp');

        foreach ($files as $file) {
            $fullPath = storage_path("app/public/{$file}");
            if (file_exists($fullPath)) {
                $lastModified = filemtime($fullPath);
                if (now()->diffInMinutes(\Carbon\Carbon::createFromTimestamp($lastModified)) > 10) {
                    Storage::disk('public')->delete($file);
                }
            }
        }

        $this->info('Arquivos temporários antigos removidos.');
    }
}
