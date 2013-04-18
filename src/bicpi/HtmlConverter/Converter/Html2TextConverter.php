<?php

namespace bicpi\HtmlConverter\Converter;

class Html2TextConverter extends AbstractCommandTemplate
{
    public function getCommand()
    {
        return '/usr/bin/env html2text -utf8 -style pretty %s';
    }

    public function convert($html)
    {
        $text = parent::convert($html);

        return html_entity_decode($text, null, 'utf-8');
    }

}
