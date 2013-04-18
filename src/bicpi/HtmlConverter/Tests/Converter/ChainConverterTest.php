<?php

namespace bicpi\HtmlConverter\Tests;

use bicpi\HtmlConverter\Exception\ConverterException;
use bicpi\HtmlConverter\Converter\ChainConverter;
use bicpi\HtmlConverter\Tests\Tool\BaseTestCase;

class Html2TextTest extends BaseTestCase
{
    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage No converter registered. At least one converter is required.
     */
    public function conversionShouldFailWithoutAnyRegisteredConverter()
    {
        $converter = new ChainConverter();
        $converter->convert($this->getFixtureContent('sample.html'));
    }

    /**
     * @test
     */
    public function converterManagementShouldWork()
    {
        $mockConverter1 = $this->getMock('bicpi\HtmlConverter\Converter\ConverterInterface');
        $mockConverter2 = $this->getMock('bicpi\HtmlConverter\Converter\ConverterInterface');
        $mockConverter3 = $this->getMock('bicpi\HtmlConverter\Converter\ConverterInterface');

        $converter = new ChainConverter();
        $converter->addConverter($mockConverter1, 'mock1');
        $this->assertEquals(1, count($converter->getConverters()));
        $converter->addConverter($mockConverter2, 'mock2');
        $this->assertTrue($converter->hasConverter('mock2'));
        $converter->addConverter($mockConverter3, 'mock3');
        $this->assertEquals(3, count($converter->getConverters()));
        $converter->removeConverter('mock2');
        $this->assertFalse($converter->hasConverter('mock2'));
        $this->assertEquals(2, count($converter->getConverters()));
    }

    /**
     * @test
     */
    public function conversionSuccessWithMockConverter()
    {
        $mockConverter = $this->getMock('bicpi\HtmlConverter\Converter\ConverterInterface');
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
    public function conversionShouldFailWithoutAnyConverterHandlingTheConversion()
    {
        $failing = $this->getMock('bicpi\HtmlConverter\Converter\ConverterInterface');
        $failing
            ->expects($this->once())
            ->method('convert')
            ->will($this->throwException(new ConverterException()));

        $converter = new ChainConverter();
        $converter->addConverter($failing, 'failing');
        $converter->convert($this->getFixtureContent('sample.html'));
    }
}
