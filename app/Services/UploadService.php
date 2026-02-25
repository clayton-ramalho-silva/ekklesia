<?php

namespace App\Services;
use Illuminate\Http\UploadedFile;

class UploadService
{
    public function uploadMembroPhoto(?\Illuminate\Http\UploadedFile $file, ?string $currentPhoto): ?string
    {
        if ($file instanceof \Illuminate\Http\UploadedFile) {
            $extension = $file->getClientOriginalExtension();
            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;
            $file->move(public_path('documents/membros/fotos'), $fileName);

            if ($currentPhoto) {
                @unlink(public_path('documents/membros/fotos/' . $currentPhoto));
            }

            return $fileName;
        }

        return $currentPhoto;
    }
}