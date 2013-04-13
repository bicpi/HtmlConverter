<?php

namespace bicpi\Component\Html2Text\Tests\Converter;

use bicpi\Component\Html2Text\Converter\SimpleConverter;
use bicpi\Component\Html2Text\Html2Text;
use bicpi\Component\Html2Text\Tests\Tool\BaseTestCase;

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