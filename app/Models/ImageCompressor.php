<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Http\UploadedFile;

class ImageCompressor
{
    /**
     * Compress and save the image.
     *
     * @param mixed $image
     * @param string $subfolder
     * @param string|null $imageFieldName
     * @param int $quality
     * @return string|null
     */
    public static function compressAndSave($image, string $subfolder, ?string $imageFieldName = 'image', int $quality = 80): ?string
{
    if ($image instanceof Request) {
        if ($imageFieldName === null) {
            throw new \InvalidArgumentException('Image field name must be provided for Request.');
        }
        // Validate the uploaded file
        $image->validate([
            $imageFieldName => 'required|image|max:2048', // Assuming max file size is 2MB
        ]);

        // Get the uploaded image
        $image = $image->file($imageFieldName);
    } elseif (!($image instanceof UploadedFile)) {
        throw new \InvalidArgumentException('Invalid image input.');
    }

    $path = $image->getPathName();

    // Generate a unique filename
    $filename = uniqid() . '.webp';

    // Determine the storage directory based on the subfolder and product name
    $storageDirectory = public_path('uploads/' . $subfolder);

    // Create the directory if it doesn't exist
    if (!file_exists($storageDirectory)) {
        mkdir($storageDirectory, 0777, true);
    }

    // Determine the storage path for the image
    $storagePath = $storageDirectory . '/' . $filename;

    // Convert image to WebP and compress
    self::convertToWebP($path, $storagePath, $quality);

    // Optimize the image
    ImageOptimizer::optimize($storagePath);

    // Return the URL to access the compressed image
    return asset('uploads/' . $subfolder . '/' . $filename);
}


    /**
     * Convert image to WebP format and compress
     *
     * @param string $inputPath
     * @param string $outputPath
     * @param int $quality
     */
    private static function convertToWebP(string $inputPath, string $outputPath, int $quality)
    {
        $image = imagecreatefromstring(file_get_contents($inputPath));

        // Check if the image was properly created
        if ($image === false) {
            throw new \Exception('Failed to create image from file.');
        }

        // Save the image in WebP format
        imagewebp($image, $outputPath, $quality);

        // Free up memory
        imagedestroy($image);
    }
}
