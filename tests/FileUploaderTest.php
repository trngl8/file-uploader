<?php

namespace Triangle\FileUploader\Tests;

use Triangle\Uploader\FileUploader;
use PHPUnit\Framework\TestCase;

class FileUploaderTest extends TestCase
{
    public function testFileUploaderSuccess()
    {
        $uploader = new FileUploader();

        $this->assertTrue($uploader->upload());
    }
}
