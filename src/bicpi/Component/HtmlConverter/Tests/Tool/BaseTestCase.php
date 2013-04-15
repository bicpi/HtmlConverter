<?php

namespace bicpi\Component\HtmlConverter\Tests\Tool;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    public function getFixtureContent($fixture)
    {
        return file_get_contents(__DIR__.'/../Fixtures/'.$fixture);
    }
}