<?php

namespace Triangle\Uploader;

class Filesystem
{
    public function open($filename, $mode)
    {
        return fopen($filename, $mode);
    }

    public function close($file): void
    {
        fclose($file);
    }

    public function getContentType($filename): string
    {
        return mime_content_type($filename);
    }

    public function writeFile($stream, string $content): void
    {
        fwrite($stream, $content);
    }

    public function deleteFile($filename): void
    {
        unlink($filename);
    }
}
