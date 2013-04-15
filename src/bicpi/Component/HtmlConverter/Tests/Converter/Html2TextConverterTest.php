<?php

namespace bicpi\Component\HtmlConverter\Tests\Converter;

use bicpi\Component\HtmlConverter\Tests\Tool\BaseTestCase;
use bicpi\Component\HtmlConverter\Converter\Html2TextConverter;

class Html2TextConverterTest extends BaseTestCase
{
    /**
     * @test
     */
    function conversionShouldRemoveHtmlAndFormatPlainText()
    {
        $converter = new Html2TextConverter();
        $plain = $converter->convert($this->getFixtureContent('sample.html'));

        $this->assertEquals($this->getFixtureContent('html2text-sample-result.txt'), $plain);
    }
}