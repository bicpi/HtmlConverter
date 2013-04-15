<?php

namespace bicpi\Component\HtmlConverter\Converter;

class SimpleConverter implements ConverterInterface
{
    public function convert($html)
    {
        return strip_tags($html);
    }
}