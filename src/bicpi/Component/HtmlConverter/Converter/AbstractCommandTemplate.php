<?php

namespace bicpi\Component\HtmlConverter\Converter;

use Symfony\Component\Process\Process;
use bicpi\Component\HtmlConverter\Exception\ConverterException;

abstract class AbstractCommandTemplate implements ConverterInterface
{
    /**
     * @return string Converter command
     */
    abstract public function getCommand();

    /**
     * @param $html Raw HTML to be converted
     * @return string Converted plain text
     * @throws \Exception
     * @throws ConverterException
     */
    public function convert($html)
    {
        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5(uniqid(mt_rand()));
        file_put_contents($path, $html);

        try {
            $process = new Process(sprintf($this->getCommand(), escapeshellarg($path)));
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ConverterException($process->getErrorOutput());
            }

            return $process->getOutput();

            unlink($path);
        } catch (\Exception $e) {
            unlink($path);
            throw $e;
        }
    }
}