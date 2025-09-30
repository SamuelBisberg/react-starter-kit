<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Utility class for file operations.
 */
class FileUtils
{
    /**
     * Get the path to the Livewire temporary files directory.
     */
    public static function getLivewireTmpPath(string $filename): string
    {
        $disk = config('livewire.temporary_file_upload.disk') ?? config('filesystems.default');
        $directory = config('livewire.temporary_file_upload.directory') ?? 'livewire-tmp';

        return Storage::disk($disk)->path($directory.'/'.$filename);
    }
}
