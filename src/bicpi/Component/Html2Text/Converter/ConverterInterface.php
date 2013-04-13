<?php

namespace bicpi\Component\Html2Text\Converter;


interface ConverterInterface
{
    /**
     * @param $html Raw HTML to be converted
     * @return mstring Converted plain text
     */
    public function convert($html);
}