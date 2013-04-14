<?php

namespace bicpi\Component\Html2Text\Converter;


class Html2TextConverter extends AbstractCommandTemplate
{
    public function getCommand()
    {
        return '/usr/bin/env html2text -utf8 -style pretty %s';
    }
}
