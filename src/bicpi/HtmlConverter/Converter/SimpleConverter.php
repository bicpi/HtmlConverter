<?php

/*
 * This file is part of the HtmlConverter library
 *
 * (c) 2013 Philipp Rieber <p.rieber@webflips.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace bicpi\HtmlConverter\Converter;

/**
 * Converter using plain PHP.
 */
class SimpleConverter implements ConverterInterface
{
    /**
     * {@inheritdoc}
     */
    public function convert($html)
    {
        return html_entity_decode(strip_tags($html), null, 'utf-8');
    }
}
