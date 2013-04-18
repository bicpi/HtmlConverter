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
 * Converter implementing the <code>lynx</code> text browser conversion.
 */
class LynxConverter extends AbstractCommandTemplate
{
    /**
     * {@inheritdoc}
     */
    public function getCommand()
    {
        return '/usr/bin/env lynx -force_html -assume_charset=utf-8 -display_charset=utf-8 -dump %s';
    }
}
