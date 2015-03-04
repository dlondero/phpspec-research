<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Markdown\Reader;
use Markdown\Writer;

class MarkdownSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Markdown');
    }

    function it_converts_plain_text_to_html_paragraphs()
    {
        $this->toHtml('Hi, there')->shouldReturn('<p>Hi, there</p>');
    }

    function it_converts_text_from_an_external_source(Reader $reader)
    {
        $reader->getMarkdown()->willReturn('Hi, there');

        $this->toHtmlFromReader($reader)->shouldReturn('<p>Hi, there</p>');
    }

    function it_outputs_converted_text(Writer $writer)
    {
        $writer->writeText('<p>Hi, there</p>')->shouldBeCalled();

        $this->outputHtml('Hi, there', $writer);
    }
}
