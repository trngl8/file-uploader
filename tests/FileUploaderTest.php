<?php

namespace Triangle\Uploader\Tests;

use Triangle\Uploader\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use PHPUnit\Framework\TestCase;

class FileUploaderTest extends TestCase
{
    public function testFileUploaderSuccess()
    {
        //TODO: here is an empty test
        $uploader = new FileUploader();
        $this->assertTrue(true);
    }
}
