<?php

namespace bicpi\HtmlConverter\Converter;

use bicpi\HtmlConverter\Converter\ConverterInterface;
use bicpi\HtmlConverter\Exception\ConverterException;

class ChainConverter implements ConverterInterface
{
    protected $converters = array();

    /**
     * @param ConverterInterface $converter Converter to be added
     * @param $alias Converter alias
     */
    public function addConverter(ConverterInterface $converter, $alias)
    {
        $this->converters[$alias] = $converter;
    }

    /**
     * @return array Array of registered converters
     */
    public function getConverters()
    {
        return $this->converters;
    }

    /**
     * @param $alias Converter alias
     * @return bool Indicates existance of converter in the converter chain
     */
    public function hasConverter($alias)
    {
        return array_key_exists($alias, $this->converters);
    }

    /**
     * @param $alias Converter alias
     * @return ConverterInterface
     * @throws \RuntimeException
     */
    public function getConverter($alias)
    {
        if ($this->hasConverter($alias)) {
            return $this->converters[$alias];
        }

        throw new \RuntimeException("Converter '{$alias}' was not chained.");
    }

    /**
     * @param $alias Converter alias
     */
    public function removeConverter($alias)
    {
        if ($this->hasConverter($alias)) {
            unset($this->converters[$alias]);
        }
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
