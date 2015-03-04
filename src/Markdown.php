<?php

use Markdown\Reader;
use Markdown\Writer;

class Markdown {

    public function toHtml($text) {
        return '<p>' . $text . '</p>';
    }

    public function toHtmlFromReader(Reader $reader)
    {
        return '<p>' . $reader->getMarkdown() . '</p>';
    }

    public function outputHtml($text, Writer $writer)
    {
        $writer->writeText('<p>' . $text . '</p>');
    }
}
