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

use bicpi\HtmlConverter\Tests\Tool\BaseTestCase;
use bicpi\HtmlConverter\Converter\Html2TextConverter;

class Html2TextConverterTest extends BaseTestCase
{
    /**
     * @test
     */
    public function conversionShouldRemoveHtmlAndFormatPlainText()
    {
        $converter = new Html2TextConverter();
        $plain = $converter->convert($this->getFixtureContent('sample.html'));

        $this->assertEquals($this->getFixtureContent('html2text-sample-result.txt'), $plain);
    }
}
