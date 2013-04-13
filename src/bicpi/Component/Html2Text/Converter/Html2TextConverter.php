<?php

namespace bicpi\Component\Html2Text\Converter;

use Symfony\Component\Process\Process;
use bicpi\Component\Html2Text\Exception\ConverterException;

class Html2TextConverter implements ConverterInterface
{
    public static $cmd = '/usr/bin/env html2text -utf8 -style pretty %s';

    /**
     * @inheritdoc
     */
    public function convert($html)
    {
        $converter = function ($path) {
            $process = new Process(sprintf(Html2TextConverter::$cmd, escapeshellarg($path)));
            $process->run();

            if (!$process->isSuccessful()) {
                $msg = sprintf('%s - %s', trim($process->getErrorOutput()), 'Package *html2text* installed?');
                throw new ConverterException($msg);
            }

            return $process->getOutput();
        };

        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5(uniqid(mt_rand()));
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
