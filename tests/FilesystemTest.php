<?php

namespace Triangle\Uploader\Tests;

use Triangle\Uploader\Filesystem;
use PHPUnit\Framework\TestCase;

class FilesystemTest extends TestCase
{
    private Filesystem $filesystem;

    public function setUp(): void
    {
        parent::setUp();
        $this->filesystem = new Filesystem();
    }

    public function testOpenCloseResourceSuccess()
    {
        $handler = $this->filesystem->open('var/test.txt', 'a+');
        $this->filesystem->close($handler);
        $this->assertTrue(true);
    }

    public function testFilesystemWrite()
    {
        $handler = $this->filesystem->open('var/test.txt', 'a+');
        $this->filesystem->writeFile($handler, 'test');
        $this->filesystem->close($handler);
        $this->assertTrue(true);
    }

    public function testFilesystemGetContentType()
    {
        $this->assertEquals('text/plain', $this->filesystem->getContentType('var/test.txt'));
    }

    public function testDeleteFile()
    {
        $this->filesystem->deleteFile('var/test.txt');
        $this->assertTrue(true);
    }
}
