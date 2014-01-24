<?php

require_once "src/parser.class.php";

class parserTest extends PHPUnit_Framework_TestCase {

    const LINK = "http://www.google.com";
    const LINK_YOUTUBE = "http://www.youtube.com/watch?v=_OBlgSz8sSM";
    const LINK_VIMEO = "http://vimeo.com/74353678";
    const LINK_IMAGE = "http://3.bp.blogspot.com/-4zsrSV3S_zw/URqltgTvv2I/AAAAAAAAArs/zS117JzqNzA/s1600/exam-sweat2.gif";

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function testSimpleLink()
    {
        $parsed = $this->parser->parseLinks(self::LINK);

        $this->assertEquals("<a href='".self::LINK."'>".self::LINK."</a>", $parsed);
    }

    public function testYoutubeLink()
    {

        $parsed = $this->parser->parseLinks(self::LINK_YOUTUBE);

        $this->checkObjectTagNotExists($parsed);

        $exists = (strpos($parsed, self::LINK_YOUTUBE) === false);
        $this->assertTrue($exists);

        $exists = (strpos($parsed, "embed") > 0);
        $this->assertTrue($exists);
    }

    public function testVimeoLink()
    {

        $parsed = $this->parser->parseLinks(self::LINK_VIMEO);

        $this->checkObjectTagNotExists($parsed);

        $exists = (strpos($parsed, self::LINK_VIMEO) === false);
        $this->assertTrue($exists);

        $exists = (strpos($parsed, "player.vimeo.com") > 0);
        $this->assertTrue($exists);
    }

    public function testCombinedLinks()
    {

        $parsed = $this->parser->parseLinks("start " . self::LINK . " aaa ". self::LINK_VIMEO." bbb " . self::LINK_YOUTUBE . " end");

        $this->assertRegExp("/^start.*/", $parsed);
        $this->assertRegExp("/.* end$/", $parsed);

        $this->assertRegExp("/.*(player.vimeo.com).*/", $parsed);
        $this->assertRegExp("/.*(youtube.com\/embed\/_).*/", $parsed);

        $this->assertTrue((strpos($parsed, "<a href='".self::LINK."'>".self::LINK."</a>") > 0) === true);
    }

    public function testImageEmbededInAnchor()
    {
        $parsed = $this->parser->parseLinks(self::LINK_IMAGE);

        $this->checkObjectTagNotExists($parsed);
        $this->assertRegExp("/.*href=.*/", $parsed);

        $this->assertTag(array("class" => "gallery"), $parsed);
        $this->assertTag(array("class" => "image"), $parsed);

    }

    private function checkObjectTagNotExists($string)
    {
        $this->assertTrue((strpos($string, "object") === false));
    }

}
