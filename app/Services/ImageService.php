<?php

namespace App\Services;

class ImageService
{
    public function compressAndStoreImage($image, $uniqueSlug, $type)
    {
        $compressedImage = imagecreatefromstring(file_get_contents($image->getRealPath()));
        $extension = 'webp'; // or any other desired extension
        $filename = $uniqueSlug . '.' . $extension;

        // Determine save path based on the type
        switch ($type) {
            case 'product':
                $directory = public_path('product-image');
                break;
            case 'collection':
                $directory = public_path('collection-image');
                break;
            case 'slider':
                $directory = public_path('product-slider-images');
                break;
            case 'igreja':
                $directory = public_path('images/igreja');
                break;
            default:
                $directory = public_path('upload-image');
                break;
        }

        // Cria o diretório se não existir
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $savePath = $directory . '/' . $filename;

        imagewebp($compressedImage, $savePath, 45); // Adjust quality as needed
        imagedestroy($compressedImage);

        return $filename;
    }
    public function convert($image, $uniqueSlug, $type, $path, $extension)
    {
        // Check if image is valid
        $compressedImage = imagecreatefromstring(file_get_contents($image->getRealPath()));
        if (!$compressedImage) {
            // Handle the error or return false
            return false;
        }
        // Set default extension
        if (!$extension) {
            $extension = 'webp';
        }
        $filename = $uniqueSlug . '.' . $extension;
        // Determine save path based on the type
        $savePath = public_path($path . '/' . $type . '/' . $filename);
        // Ensure directory exists
        $directory = dirname($savePath);
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0755, true)) {
                // Handle directory creation failure
                return false;
            }
        }
        imagewebp($compressedImage, $savePath, 100); // Adjust quality as needed
        imagedestroy($compressedImage);
        return $filename;
    }
}
