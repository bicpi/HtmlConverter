<?php

/*
 * This file is part of the HtmlConverter library
 *
 * (c) 2013 Philipp Rieber <p.rieber@webflips.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace bicpi\HtmlConverter\Converter;

use Symfony\Component\Process\Process;
use bicpi\HtmlConverter\Exception\ConverterException;

/**
 * Template for command line converters.
 */
abstract class AbstractCommandTemplate implements ConverterInterface
{
    /**
     * @return string Converter command
     */
    abstract public function getCommand();

    /**
     * @param  string             $html Raw HTML to be converted
     * @return string             Converted plain text
     * @throws ConverterException When command does not execute successfully
     * @throws \Exception         When something unexpected happens
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
