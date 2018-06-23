<?php

namespace PiPHP\PWM\Pin;

use PiPHP\PWM\FileSystem\FileSystemInterface;

final class Pin implements PinInterface
{
    // Paths
    const PWM_PATH = '/sys/class/pwm/';
    const PWM_PREFIX = 'pwmchip';

    // Files
    const PWM_FILE_EXPORT = 'export';
    const PWM_FILE_UNEXPORT = 'unexport';

    // Pin files
    const PWM_PIN_FILE_DUTY_CYCLE = 'duty_cycle';
    const PWM_PIN_FILE_ENABLE = 'enable';
    const PWM_PIN_FILE_PERIOD = 'period';

    protected $fileSystem;
    protected $number;

    /**
     * Constructor.
     * 
     * @param FileSystemInterface $fileSystem An object that provides file system access
     * @param int                 $number     The number of the pin
     */
    public function __construct(FileSystemInterface $fileSystem, $number)
    {
        $this->fileSystem = $fileSystem;
        $this->number = $number;

        $this->export();
    }

    /**
     * {@inheritdoc}
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * {@inheritdoc}
     */
    public function export()
    {
        $this->writePinNumberToFile($this->getFile(self::PWM_FILE_EXPORT));
    }

    /**
     * {@inheritdoc}
     */
    public function unexport()
    {
        $this->writePinNumberToFile($this->getFile(self::PWM_FILE_UNEXPORT));
    }

    /**
     * Get the path of the import or export file.
     * 
     * @param string $file The type of file (import/export)
     * 
     * @return string The file path
     */
    private function getFile($file)
    {
        return self::PWM_PATH . $file;
    }

    /**
     * Get the path of a pin access file.
     * 
     * @param string $file The type of pin file (duty_cycle/enable/period)
     * 
     * @return string
     */
    protected function getPinFile($file)
    {
        return self::PWM_PATH . self::PWM_PREFIX . $this->getNumber() . '/' . $file;
    }

    /**
     * Write the pin number to a file.
     * 
     * @param string $file The file to write to
     */
    private function writePinNumberToFile($file)
    {
        $this->fileSystem->putContents($file, $this->getNumber());
    }
}
