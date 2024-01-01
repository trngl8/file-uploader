<?php

namespace Triangle\Uploader;

use Symfony\Component\HttpFoundation\File\File;

class Filesystem
{
    public function moveUploadedFile(File $file, string $filename): void
    {
        move_uploaded_file($file->getRealPath(), $filename);
    }

    public function writeFile($filename, $content, $flags = 0): void
    {
        fwrite($filename, $content, $flags);
    }

    public function deleteFile($filename): void
    {
        unlink($filename);
    }

    public function open($filename, $mode)
    {
        return fopen($filename, $mode);
    }

    public function close($filename): void
    {
        fclose($filename);
    }

    public function getContentType($filename): string
    {
        return mime_content_type($filename);
    }
}
