<?php

/*
 * This file is part of the HtmlConverter library
 *
 * (c) Philipp Rieber <p.rieber@webflips.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
