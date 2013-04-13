<?php

namespace bicpi\Component\Html2Text\Converter;

use Symfony\Component\Process\Process;
use bicpi\Component\Html2Text\Exception\ConverterException;

class LynxConverter implements ConverterInterface
{
    public static $cmd = '/usr/bin/env lynx -assume_charset=utf-8 -display_charset=utf-8 -dump %s';

    /**
     * @inheritdoc
     */
    public function convert($html)
    {
        $converter = function ($path) {
            $process = new Process(sprintf(LynxConverter::$cmd, escapeshellarg($path)));
            $process->run();

            if (!$process->isSuccessful()) {
                $msg = sprintf('%s - %s', trim($process->getErrorOutput()), 'Package *lynx* installed?');
                throw new ConverterException($msg);
            }

            return preg_replace('!file://.+//!iU', '', $process->getOutput());
        };

        // Lynx converter needs ".html" extension!
        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5(uniqid(mt_rand())) . '.html';
        file_put_contents($path, $html);

        try {
            return call_user_func($converter, $path);
            unlink($path);
        } catch (\Exception $e) {
            unlink($path);
            throw $e;
        }
    }
}
