<?php

namespace bicpi\Component\HtmlConverter\Converter;

class Html2TextConverter extends AbstractCommandTemplate
{
    public function getCommand()
    {
        return '/usr/bin/env html2text -utf8 -style pretty %s';
    }
}
