<?php

namespace bicpi\HtmlConverter\Converter;

class SimpleConverter implements ConverterInterface
{
    public function convert($html)
    {
        return strip_tags($html);
    }
}