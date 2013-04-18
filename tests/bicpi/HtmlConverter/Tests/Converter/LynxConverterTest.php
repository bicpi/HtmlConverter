<?php

/*
 * This file is part of the HtmlConverter library
 *
 * (c) Philipp Rieber <p.rieber@webflips.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace bicpi\HtmlConverter\Converter;

use bicpi\HtmlConverter\Tests\Tool\BaseTestCase;
use bicpi\HtmlConverter\Converter\LynxConverter;

class LynxConverterTest extends BaseTestCase
{
    /**
     * @test
     */
    public function conversionShouldRemoveHtmlAndFormatPlainText()
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
