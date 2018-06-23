<?php

namespace PiPHP\PWM;

use PiPHP\PWM\FileSystem\FileSystem;
use PiPHP\PWM\FileSystem\FileSystemInterface;
use PiPHP\PWM\Pin\Pin;

final class PWM implements PWMInterface
{
    private $fileSystem;

    /**
     * Constructor.
     * 
     * @param FileSystemInterface $fileSystem Optional file system object to use
     */
    public function __construct(FileSystemInterface $fileSystem = null)
    {
        $this->fileSystem = $fileSystem ?: new FileSystem();
    }

    /**
     * {@inheritdoc}
     */
    public function getPin($number)
    {
        return new Pin($this->fileSystem, $number);
    }
}
