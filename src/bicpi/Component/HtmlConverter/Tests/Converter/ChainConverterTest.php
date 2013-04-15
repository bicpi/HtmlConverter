<?php

namespace bicpi\Component\HtmlConverter\Tests;

use bicpi\Component\HtmlConverter\Exception\ConverterException;
use bicpi\Component\HtmlConverter\Converter\ChainConverter;
use bicpi\Component\HtmlConverter\Tests\Tool\BaseTestCase;

class Html2TextTest extends BaseTestCase
{
    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage No converter registered. At least one converter is required.
     */
    function conversionShouldFailWithoutAnyRegisteredConverter()
    {
        $converter = new ChainConverter();
        $converter->convert($this->getFixtureContent('sample.html'));
    }

    /**
     * @test
     */
    function conversionSuccessWithMockConverter()
    {
        $mockConverter = $this->getMock('bicpi\Component\HtmlConverter\Converter\ConverterInterface');
        $mockConverter
            ->expects($this->once())
            ->method('convert')
            ->will($this->returnValue('Foobar'));

        $converter = new ChainConverter();
        $converter->addConverter($mockConverter, 'mock');
        $plain = $converter->convert('<h1>Foobar</h1>');

        $this->assertEquals('Foobar', $plain);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage No converter was able to handle conversion.
     */
    function conversionShouldFailWithoutAnyConverterHandlingTheConversion()
    {
        $failing = $this->getMock('bicpi\Component\HtmlConverter\Converter\ConverterInterface');
        $failing
            ->expects($this->once())
            ->method('convert')
            ->will($this->throwException(new ConverterException()));

        $converter = new ChainConverter();
        $converter->addConverter($failing, 'failing');
        $converter->convert($this->getFixtureContent('sample.html'));
    }
}