<?php

namespace bicpi\HtmlConverter\Tests\Converter;

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
