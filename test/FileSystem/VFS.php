<?php

namespace PiPHP\Test\PWM\FileSystem;

use PiPHP\PWM\FileSystem\FileSystemInterface;

class VFS implements FileSystemInterface
{
    private $vfs = [];

    public function open($path, $mode) {}

    public function getContents($path)
    {
        return $this->vfs[$path];
    }

    public function putContents($path, $buffer)
    {
        $this->vfs[$path] = $buffer;
    }
}
