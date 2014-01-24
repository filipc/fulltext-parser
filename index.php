<?php

// simple usage from cli environment

require_once './src/parser.class.php';

$parser = new Parser();

echo "\n\n### 1 ###\n\n";

echo $parser->parseLinks("http://www.google.com");

echo "\n\n### 2 ###\n\n";

// display youtube player from link
echo $parser->parseLinks("http://www.youtube.com/watch?v=_OBlgSz8sSM");

echo "\n\n### 3 ###\n\n";

// display vimeo player from link
echo $parser->parseLinks("http://vimeo.com/74353678");

echo "\n\n### 4 ###\n\n";

// link to image changed to img <tag> embedded in <a> tag
echo $parser->parseLinks("http://3.bp.blogspot.com/-4zsrSV3S_zw/URqltgTvv2I/AAAAAAAAArs/zS117JzqNzA/s1600/exam-sweat2.gif");

echo "\n\n";