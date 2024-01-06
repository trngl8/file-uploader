<?php

namespace Triangle\Uploader;

use Symfony\Component\HttpFoundation\File\File;

class FileUploader
{
    public function upload(File $file, string $filename): bool
    {
        return move_uploaded_file($file->getRealPath(), $filename);
    }
}
