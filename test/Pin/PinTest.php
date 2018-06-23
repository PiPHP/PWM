<?php

namespace PiPHP\Test\PWM\Pin;

use PiPHP\PWM\PWM;
use PiPHP\Test\PWM\FileSystem\VFS;

class PinTest extends \PHPUnit_Framework_TestCase
{
    public function testPin()
    {
        $vfs = new VFS();
        $pwm = new PWM($vfs);

        $pin = $pwm->getPin(2);

        $this->assertEquals('2', $vfs->getContents('/sys/class/pwm/export'));
 
        $pin->unexport();
        $this->assertEquals('2', $vfs->getContents('/sys/class/pwm/unexport'));
    }
}
