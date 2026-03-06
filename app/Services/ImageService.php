<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    /**
     * Delete a single file from public disk (safe: ignores missing files and external URLs).
     */
    public function deleteFile(?string $path): void
    {
        if (!$path) return;
        // Don't delete external URLs (preset backgrounds etc.)
        if (str_starts_with($path, 'http')) return;

        Storage::disk('public')->delete($path);
    }

    /**
     * Delete a file and its companion thumbnail (stored in thumbs/ sub-folder).
     * Derives the thumb path automatically from the full path.
     */
    public function deleteWithThumb(?string $path, ?string $thumbPath = null): void
    {
        $this->deleteFile($path);

        if ($thumbPath) {
            $this->deleteFile($thumbPath);
        } elseif ($path) {
            // Try to infer thumb path: dir/thumbs/filename
            $dir      = dirname($path);
            $filename = basename($path);
            $this->deleteFile("{$dir}/thumbs/{$filename}");
        }
    }

    /**
     * Process and store an image (full size only, no thumbnail).
     * Uses scaleDown to preserve aspect ratio.
     *
     * @param  UploadedFile  $file
     * @param  string  $slug     Memorial slug (used as folder name)
     * @param  string  $folder   Sub-folder: 'profile'|'background'|'grave'|etc.
     * @param  int     $maxPx    Max dimension (longest side) in pixels
     * @return string            Relative path for Storage::url()
     */
    public function processAndStore(
        UploadedFile $file,
        string $slug,
        string $folder,
        int $maxPx
    ): string {
        $filename = Str::uuid() . '.webp';
        $relativePath = "{$slug}/{$folder}/{$filename}";
        $absolutePath = Storage::disk('public')->path($relativePath);

        // Ensure directory exists
        $dir = dirname($absolutePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        Image::read($file->getRealPath())
            ->scaleDown(width: $maxPx, height: $maxPx)
            ->toWebp(quality: 90)
            ->save($absolutePath);

        return $relativePath;
    }

    /**
     * Process and store an image with a thumbnail.
     * Both full and thumb use scaleDown (aspect ratio preserved).
     *
     * @param  UploadedFile  $file
     * @param  string  $slug
     * @param  string  $folder
     * @param  int     $maxPx       Max dimension for full size
     * @param  int     $thumbMaxPx  Max dimension for thumbnail
     * @return array{path: string, thumb: string}
     */
    public function processAndStoreWithThumb(
        UploadedFile $file,
        string $slug,
        string $folder,
        int $maxPx,
        int $thumbMaxPx
    ): array {
        $filename = Str::uuid() . '.webp';
        $relativePath = "{$slug}/{$folder}/{$filename}";
        $thumbRelativePath = "{$slug}/{$folder}/thumbs/{$filename}";

        $absolutePath = Storage::disk('public')->path($relativePath);
        $thumbAbsolutePath = Storage::disk('public')->path($thumbRelativePath);

        // Ensure directories exist
        foreach ([$absolutePath, $thumbAbsolutePath] as $path) {
            $dir = dirname($path);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }

        // Full size — read once, save, then read again for thumb
        $image = Image::read($file->getRealPath());

        $image->scaleDown(width: $maxPx, height: $maxPx)
            ->toWebp(quality: 85)
            ->save($absolutePath);

        // Thumbnail — re-read original to avoid quality loss from chaining
        Image::read($file->getRealPath())
            ->scaleDown(width: $thumbMaxPx, height: $thumbMaxPx)
            ->toWebp(quality: 75)
            ->save($thumbAbsolutePath);

        return [
            'path'  => $relativePath,
            'thumb' => $thumbRelativePath,
        ];
    }
}
