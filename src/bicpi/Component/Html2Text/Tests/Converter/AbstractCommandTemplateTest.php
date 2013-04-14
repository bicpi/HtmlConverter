<?php

namespace bicpi\Component\Html2Text\Tests\Converter;

use bicpi\Component\Html2Text\Tests\Tool\BaseTestCase;

class AbstractCommandTemplateTest extends BaseTestCase
{
    /**
     * @test
     * @expectedException bicpi\Component\Html2Text\Exception\ConverterException
     */
    function failingConversionShouldAbort()
    {
        $converter = $this->getMockForAbstractClass('bicpi\Component\Html2Text\Converter\AbstractCommandTemplate');
        $converter
            ->expects($this->once())
            ->method('getCommand')
            ->will($this->returnValue('notExistingCliCommand %s'));

        $converter->convert($this->getFixtureContent('sample.html'));
    }
}