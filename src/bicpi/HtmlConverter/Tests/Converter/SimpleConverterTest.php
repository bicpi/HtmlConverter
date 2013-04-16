<?php

namespace bicpi\HtmlConverter\Tests\Converter;

use bicpi\HtmlConverter\Converter\SimpleConverter;
use bicpi\HtmlConverter\Html2Text;
use bicpi\HtmlConverter\Tests\Tool\BaseTestCase;

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