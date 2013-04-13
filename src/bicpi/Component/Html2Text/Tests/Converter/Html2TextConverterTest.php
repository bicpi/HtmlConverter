<?php

namespace bicpi\Component\Html2Text\Tests\Converter;

use bicpi\Component\Html2Text\Converter\Html2TextConverter;
use bicpi\Component\Html2Text\Html2Text;
use bicpi\Component\Html2Text\Tests\Tool\BaseTestCase;

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

    /**
     * @test
     * @expectedException bicpi\Component\Html2Text\Exception\ConverterException
     */
    function failingConversionShouldAbort()
    {
        $converter = new Html2TextConverter();
        $r = new \ReflectionClass($converter);
        $r->setStaticPropertyValue('cmd', 'notExistingCliCommand %s');

        $converter->convert($this->getFixtureContent('sample.html'));
    }
}