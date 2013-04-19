<?php

/*
 * This file is part of the HtmlConverter library
 *
 * (c) 2013 Philipp Rieber <p.rieber@webflips.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace bicpi\HtmlConverter\Tests\Tool;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    public function getFixtureContent($fixture)
    {
        return file_get_contents(dirname(__DIR__).'/Fixtures/'.$fixture);
    }
}
