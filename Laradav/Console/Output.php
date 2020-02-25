<?php

namespace Laradav\Console;

use DOMDocument;

class Output
{
    private $stdout;

    private $tags = [
        '#text' => '%s',
        'b' => "\e[1m%s\e[0m",
        'em' => "\e[32m%s\e[0m",
        'i' => "\e[33m%s\e[0m",
    ];

    public function __construct($stdout = STDOUT)
    {
        $this->stdout = $stdout;
    }

    public function print($text)
    {
        $xml = new DOMDocument;
        $xml->loadXML("<root>$text</root>", LIBXML_NOERROR);
        foreach ($xml->firstChild->childNodes as $ch) {
            fwrite($this->stdout, sprintf($this->tags[$ch->nodeName], $ch->nodeValue));
        }
    }
}
