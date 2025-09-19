<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\GifEncoder;
use Intervention\Image\Encoders\BmpEncoder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Resize and save an uploaded image
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $filename
     * @param int $maxWidth
     * @param int $maxHeight
     * @param string $disk
     * @return string
     */
    public function resizeAndSave(UploadedFile $file, string $path, string $filename, int $maxWidth, int $maxHeight, string $disk = 'public'): string
    {
        // Read the image
        $image = $this->manager->read($file->getPathname());

        // Get original dimensions
        $originalWidth = $image->width();
        $originalHeight = $image->height();

        // Calculate new dimensions while maintaining aspect ratio
        $newDimensions = $this->calculateDimensions($originalWidth, $originalHeight, $maxWidth, $maxHeight);

        // Resize the image
        $image->resize($newDimensions['width'], $newDimensions['height']);

        // Convert to the appropriate format
        $extension = strtolower($file->getClientOriginalExtension());
        $encoder = $this->getImageEncoder($extension);

        // Encode the image
        $encodedImage = $image->encode($encoder);

        // Save the image
        $fullPath = $path . '/' . $filename;
        Storage::disk($disk)->put($fullPath, $encodedImage);

        return $fullPath;
    }

    /**
     * Calculate new dimensions while maintaining aspect ratio
     *
     * @param int $originalWidth
     * @param int $originalHeight
     * @param int $maxWidth
     * @param int $maxHeight
     * @return array
     */
    protected function calculateDimensions(int $originalWidth, int $originalHeight, int $maxWidth, int $maxHeight): array
    {
        // If image is already smaller than max dimensions, return original
        if ($originalWidth <= $maxWidth && $originalHeight <= $maxHeight) {
            return ['width' => $originalWidth, 'height' => $originalHeight];
        }

        // Calculate scaling factor
        $widthRatio = $maxWidth / $originalWidth;
        $heightRatio = $maxHeight / $originalHeight;
        $scale = min($widthRatio, $heightRatio);

        return [
            'width' => (int) round($originalWidth * $scale),
            'height' => (int) round($originalHeight * $scale)
        ];
    }

    /**
     * Get the appropriate image encoder for encoding
     *
     * @param string $extension
     * @return object
     */
    protected function getImageEncoder(string $extension): object
    {
        return match ($extension) {
            'jpg', 'jpeg' => new JpegEncoder(90), // 90% quality
            'png' => new PngEncoder(),
            'webp' => new WebpEncoder(90), // 90% quality
            'gif' => new GifEncoder(),
            'bmp' => new BmpEncoder(),
            default => new JpegEncoder(90) // Default to JPEG with 90% quality
        };
    }

    /**
     * Resize template image to required dimensions
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $filename
     * @param string $disk
     * @return string
     */
    public function resizeTemplateImage(UploadedFile $file, string $path, string $filename, string $disk = 'public'): string
    {
        return $this->resizeAndSave($file, $path, $filename, 1125, 800, $disk);
    }

    /**
     * Resize signature image to required dimensions
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $filename
     * @param string $disk
     * @return string
     */
    public function resizeSignatureImage(UploadedFile $file, string $path, string $filename, string $disk = 'public'): string
    {
        return $this->resizeAndSave($file, $path, $filename, 200, 105, $disk);
    }
}
