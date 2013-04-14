<?php

namespace bicpi\Component\Html2Text\Tests\Converter;

use bicpi\Component\Html2Text\Tests\Tool\BaseTestCase;
use bicpi\Component\Html2Text\Converter\Html2TextConverter;

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