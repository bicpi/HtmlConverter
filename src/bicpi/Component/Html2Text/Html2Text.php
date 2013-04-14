<?php

namespace bicpi\Component\Html2Text;

use Symfony\Component\Process\Process;
use bicpi\Component\Html2Text\Converter\ConverterInterface;
use bicpi\Component\Html2Text\Exception\ConverterException;

class Html2Text implements ConverterInterface
{
    protected $converters = array();

    public function addConverter(ConverterInterface $converter)
    {
        $this->converters[] = $converter;
    }

    public function convert($html)
    {
        if (!$this->converters) {
            throw new \RuntimeException('No converter registered. At least one converter is required.');
        }

        foreach ($this->converters as $converter) {
            /** @var $converter ConverterInterface */
            try {
                return $converter->convert($html);
            } catch (ConverterException $e) {
                continue;
            }
        }

        throw new \RuntimeException('No converter was able to handle conversion.');
    }
}
