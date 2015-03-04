<?php

class MarkdownTest extends PHPUnit_Framework_TestCase
{
    // Classic approach

    public function testToHtml() {
        $this->assertEquals('<p>Hi, there</p>', (new Markdown())->toHtml('Hi, there'));
    }

    public function testToHtmlFromReader() {
        $readerStub = $this->getMockBuilder('Markdown\Reader')->getMock();
        $readerStub->method('getMarkdown')->willReturn('Hi, there');

        $this->assertEquals('<p>Hi, there</p>', (new Markdown())->toHtmlFromReader($readerStub));
    }

    public function testOutputHtml() {
        $writerMock = $this->getMockBuilder('Markdown\Writer')->getMock();
        $writerMock->expects($this->once())->method('writeText');

        (new Markdown())->outputHtml('Hi, there', $writerMock);
    }

    // More natural language

    public function testItConvertsPlainTextToHtmlParagraphs() {
        $this->assertEquals('<p>Hi, there</p>', (new Markdown())->toHtml('Hi, there'));
    }

    public function testItConvertsTextFromAnExternalSource() {
        $readerStub = $this->getMockBuilder('Markdown\Reader')->getMock();
        $readerStub->method('getMarkdown')->willReturn('Hi, there');

        $this->assertEquals('<p>Hi, there</p>', (new Markdown())->toHtmlFromReader($readerStub));
    }

    public function testItOutputsConvertedText() {
        $writerMock = $this->getMockBuilder('Markdown\Writer')->getMock();
        $writerMock->expects($this->once())->method('writeText');

        (new Markdown())->outputHtml('Hi, there', $writerMock);
    }

    // Same tests using Prophecy included in PHPUnit since 4.5

    public function testItConvertsTextFromAnExternalSourceWithProphecy() {
        $readerStub = $this->prophesize('Markdown\Reader');
        $readerStub->getMarkdown()->willReturn('Hi, there');

        $this->assertEquals('<p>Hi, there</p>', (new Markdown())->toHtmlFromReader($readerStub->reveal()));
    }

    public function testItOutputsConvertedTextWithProphecy() {
        $writerMock = $this->prophesize('Markdown\Writer');
        $writerMock->writeText('<p>Hi, there</p>')->shouldBeCalledTimes(1);

        (new Markdown())->outputHtml('Hi, there', $writerMock->reveal());
    }
}
