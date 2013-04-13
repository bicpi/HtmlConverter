<?php

namespace bicpi\Component\Html2Text\Tests\Converter;

use bicpi\Component\Html2Text\Tests\Tool\BaseTestCase;
use bicpi\Component\Html2Text\Converter\LynxConverter;

class LynxConverterTest extends BaseTestCase
{
    /**
     * @test
     */
    function conversionShouldRemoveHtmlAndFormatPlainText()
    {
        $converter = new LynxConverter();
        $plain = $converter->convert($this->getFixtureContent('sample.html'));

        $this->assertEquals($this->getFixtureContent('lynx-sample-result.txt'), $plain);
    }

    /**
     * @test
     * @expectedException bicpi\Component\Html2Text\Exception\ConverterException
     */
    function failingConversionShouldAbort()
    {
        $converter = new LynxConverter();
        $r = new \ReflectionClass($converter);
        $r->setStaticPropertyValue('cmd', 'notExistingCliCommand %s');

        $converter->convert($this->getFixtureContent('sample.html'));
    }
}