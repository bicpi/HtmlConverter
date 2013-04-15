<?php

namespace bicpi\Component\HtmlConverter\Tests\Converter;

use bicpi\Component\HtmlConverter\Tests\Tool\BaseTestCase;

class AbstractCommandTemplateTest extends BaseTestCase
{
    /**
     * @test
     * @expectedException bicpi\Component\HtmlConverter\Exception\ConverterException
     */
    function failingConversionShouldAbort()
    {
        $converter = $this->getMockForAbstractClass('bicpi\Component\HtmlConverter\Converter\AbstractCommandTemplate');
        $converter
            ->expects($this->once())
            ->method('getCommand')
            ->will($this->returnValue('/dev/null/command %s'));

        $converter->convert($this->getFixtureContent('sample.html'));
    }
}