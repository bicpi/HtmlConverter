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
 * Converter implementing the <code>html2text</code> command line conversion.
 */
class Html2TextConverter extends AbstractCommandTemplate
{
    /**
     * {@inheritdoc}
     */
    public function getCommand()
    {
        return '/usr/bin/env html2text -utf8 -style pretty %s';
    }

    /**
     * {@inheritdoc}
     */
    public function convert($html)
    {
        $text = parent::convert($html);

        return html_entity_decode($text, null, 'utf-8');
    }

}
