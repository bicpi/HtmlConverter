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

use bicpi\HtmlConverter\Converter\SimpleConverter;
use bicpi\HtmlConverter\Tests\Tool\BaseTestCase;

class SimpleConverterTest extends BaseTestCase
{
    /**
     * @test
     */
    public function conversionShouldRemoveHtml()
    {
        $html = $this->getFixtureContent('sample.html');

        $converter = new SimpleConverter();
        $plain = $converter->convert($html);

        $this->assertEquals($this->getFixtureContent('simple-sample-result.txt'), $plain);
    }
}
