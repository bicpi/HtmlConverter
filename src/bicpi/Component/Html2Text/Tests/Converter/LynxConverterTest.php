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

        // If exists, remove LC (locale) dependent "References" line
        if (false !== strpos($plain, "\n")) {
            $aPlain = explode("\n", $plain);
            if (isset($aPlain[count($aPlain)-4])) {
                unset($aPlain[count($aPlain)-4]);
            }
            $plain = implode("\n", $aPlain);
        }

        $this->assertEquals($this->getFixtureContent('lynx-sample-result.txt'), $plain);
    }
}