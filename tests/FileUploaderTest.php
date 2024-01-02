<?php

namespace Triangle\Uploader\Tests;

use Triangle\Uploader\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use PHPUnit\Framework\TestCase;

class FileUploaderTest extends TestCase
{
    public function testFileUploaderSuccess()
    {
        $uploader = new FileUploader();
        $file = new File('var/test.txt');
        $this->assertTrue($uploader->upload($file, 'var/test_uploaded.txt'));
    }
}
