<?php

namespace bicpi\Component\HtmlConverter\Converter;

use Symfony\Component\Process\Process;
use bicpi\Component\HtmlConverter\Converter\ConverterInterface;
use bicpi\Component\HtmlConverter\Exception\ConverterException;

class ChainConverter implements ConverterInterface
{
    protected $converters = array();

    public function addConverter(ConverterInterface $converter, $alias)
    {
        $this->converters[$alias] = $converter;
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
