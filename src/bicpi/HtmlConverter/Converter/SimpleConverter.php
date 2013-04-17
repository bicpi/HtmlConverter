<?php

namespace bicpi\HtmlConverter\Converter;

class SimpleConverter implements ConverterInterface
{
    public function convert($html)
    {
        return html_entity_decode(strip_tags($html), null, 'utf-8');
    }
}