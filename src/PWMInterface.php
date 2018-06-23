<?php

namespace PiPHP\GPIO;

use PiPHP\PWM\Pin\PinInterface;

interface PWMInterface
{
    /**
     * Get a pin.
     * 
     * @param int $number The pin number
     * 
     * @return PinInterface
     */
    public function getPin($number);
}
