<?php

namespace bicpi\HtmlConverter\Tests\Tool;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    public function getFixtureContent($fixture)
    {
        return file_get_contents(dirname(__DIR__).'/Fixtures/'.$fixture);
    }
}
