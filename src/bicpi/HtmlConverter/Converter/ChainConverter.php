<?php

/*
 * This file is part of the HtmlConverter library
 *
 * (c) Philipp Rieber <p.rieber@webflips.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace bicpi\HtmlConverter\Converter;

use bicpi\HtmlConverter\Converter\ConverterInterface;
use bicpi\HtmlConverter\Exception\ConverterException;

/**
 * Converter that chains multiple other converters.
 *
 * First appropriate converter will handle the conversion
 */
class ChainConverter implements ConverterInterface
{
    protected $converters = array();

    /**
     * @param $converter ConverterInterface Converter to be added
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
     * @param $alias Converter alias to check for
     * @return bool Indicates existance of converter in the converter chain
     */
    public function hasConverter($alias)
    {
        return array_key_exists($alias, $this->converters);
    }

    /**
     * @param $alias Converter alias to retrieve
     * @return ConverterInterface Aliased converter
     * @throws \RuntimeException  When converter was not found
     */
    public function getConverter($alias)
    {
        if ($this->hasConverter($alias)) {
            return $this->converters[$alias];
        }

        throw new \RuntimeException("Converter '{$alias}' was not chained.");
    }

    /**
     * @param $alias Converter alias to remove
     */
    public function removeConverter($alias)
    {
        if ($this->hasConverter($alias)) {
            unset($this->converters[$alias]);
        }
    }

    /**
     * {@inheritdoc}
     */
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
