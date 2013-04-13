<?php

namespace bicpi\Component\Html2Text\Converter;


class SimpleConverter implements ConverterInterface
{
    public function convert($html)
    {
        return strip_tags($html);
    }
}