<?php

namespace bicpi\HtmlConverter\Converter;

class LynxConverter extends AbstractCommandTemplate
{
    public function getCommand()
    {
        return '/usr/bin/env lynx -force_html -assume_charset=utf-8 -display_charset=utf-8 -dump %s';
    }
}
