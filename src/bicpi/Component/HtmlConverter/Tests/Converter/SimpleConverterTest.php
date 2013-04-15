<?php

namespace bicpi\Component\HtmlConverter\Tests\Converter;

use bicpi\Component\HtmlConverter\Converter\SimpleConverter;
use bicpi\Component\HtmlConverter\Html2Text;
use bicpi\Component\HtmlConverter\Tests\Tool\BaseTestCase;

class SimpleConverterTest extends BaseTestCase
{
    /**
     * @test
     */
    function conversionShouldRemoveHtml()
    {
        $html = $this->getFixtureContent('sample.html');

        $converter = new SimpleConverter();
        $plain = $converter->convert($html);

        $this->assertEquals(strip_tags($html), $plain);
    }
}