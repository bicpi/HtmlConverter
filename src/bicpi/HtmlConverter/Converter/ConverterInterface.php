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

/**
 * Interface for converter implementations.
 */
interface ConverterInterface
{
    /**
     * @param $html Raw HTML to be converted
     * @return string Converted plain text
     */
    public function convert($html);
}
