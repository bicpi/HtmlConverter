<?php

namespace bicpi\Component\Html2Text\Tests;

use bicpi\Component\Html2Text\Converter\ConverterInterface;
use bicpi\Component\Html2Text\Exception\ConverterException;
use bicpi\Component\Html2Text\Html2Text;
use bicpi\Component\Html2Text\Tests\Tool\BaseTestCase;

class Html2TextTest extends BaseTestCase
{
    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage No converter registered. At least one converter is required.
     */
    function conversionShouldFailWithoutAnyRegisteredConverter()
    {
        $converter = new Html2Text();
        $converter->convert($this->getFixtureContent('sample.html'));
    }
    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage No converter was able to handle conversion.
     */
    function conversionShouldFailWithoutAnyConverterHandlingTheConversion()
    {
        $failing = $this->getMock('bicpi\Component\Html2Text\Converter\ConverterInterface');
        $failing
            ->expects($this->once())
            ->method('convert')
            ->will($this->throwException(new ConverterException()));

        $converter = new Html2Text();
        $converter->addConverter($failing);
        $converter->convert($this->getFixtureContent('sample.html'));
    }
}