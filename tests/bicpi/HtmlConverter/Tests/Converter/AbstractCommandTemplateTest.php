<?php

namespace bicpi\HtmlConverter\Tests\Converter;

use bicpi\HtmlConverter\Tests\Tool\BaseTestCase;

class AbstractCommandTemplateTest extends BaseTestCase
{
    /**
     * @test
     * @expectedException bicpi\HtmlConverter\Exception\ConverterException
     */
    public function failingConversionShouldAbort()
    {
        $converter = $this->getMockForAbstractClass('bicpi\HtmlConverter\Converter\AbstractCommandTemplate');
        $converter
            ->expects($this->once())
            ->method('getCommand')
            ->will($this->returnValue('/dev/null/command %s'));

        $converter->convert($this->getFixtureContent('sample.html'));
    }
}
