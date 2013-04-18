<?php

namespace bicpi\HtmlConverter\Tests\Converter;

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
