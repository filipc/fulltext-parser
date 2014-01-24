<?php

/**
 * Parser class
 */

class Parser {

    public function parseLinks($text) {

        $regs = array(
                // VIDEO
                // youtube.com
                "#(?:http://)*(?:www\.)*(?:youtube\.[a-z]+/[a-z\?\&]*v[/|=]|youtu\.be/)([0-9a-zA-Z-_]+)&?[\w;=\-]*#" => "<iframe title=\"YouTube video player\" width=\"560\" height=\"349\" src=\"http://www.youtube.com/embed/$1?rel=0\" frameborder=\"0\" allowfullscreen></iframe>",
                // vimeo.com
                "#(?:http://)*vimeo\.com\/(\d+)#" => "<iframe src=\"http://player.vimeo.com/video/$1\" width=\"400\" height=\"225\" frameborder=\"0\"></iframe>",
                // wrzuta.pl
                "#(?:[htp:/])*(\w+).wrzuta.pl/film/(.*)/[\w\>]*#" => "<script type=\"text/javascript\" src=\"http://www.wrzuta.pl/embed_video.js?key=$2&login=$1&width=450&height=387&bg=ffffff\"></script>",
                // myspace.com
                "#(?:[htp:/w.])*myspace.com/\w+/videos/\w+/(\d+)#" => "<object width=\"425px\" height=\"360px\" ><param name=\"allowScriptAccess\" value=\"always\"/><param name=\"allowFullScreen\" value=\"true\"/><param name=\"wmode\" value=\"transparent\"/><param name=\"movie\" value=\"http://mediaservices.myspace.com/services/media/embed.aspx/m=$1,t=1,mt=video\"/><embed src=\"http://mediaservices.myspace.com/services/media/embed.aspx/m=$1,t=1,mt=video\" width=\"425\" height=\"360\" allowFullScreen=\"true\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" allowScriptAccess=\"always\"></embed></object>",
                // megavideo.com
                "#(?:[htp:/w.]*)*megavideo.com/\?v=(\w+)#" => "<object width=\"450\" height=\"330\"><param name=\"movie\" value=\"http://www.megavideo.com/v/$1\"></param><param name=\"allowFullScreen\" value=\"true\"></param><embed src=\"http://www.megavideo.com/v/$1\" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" width=\"450\" height=\"330\"></embed></object>",
                // dailymotion.com
                "~(?:[htp:/w.]*)dailymotion.(?:com|pl)\/video\/([a-zA-Z0-9]+)[\w_-]*#?[\w-]*~" => "<iframe frameborder=\"0\" width=\"480\" height=\"271\" src=\"http://www.dailymotion.pl/embed/video/$1?theme=none&wmode=transparent\"></iframe>",
                // metacafe.com
                "#(?:[htp:/]*)(?:[w.]*)metacafe.com/watch/(\d+)/(\w+)/#" => "<div style=\"background:#000000;width:440px;height:272px\"><embed flashVars=\"playerVars=showStats=no|autoPlay=no|\" src=\"http://www.metacafe.com/fplayer/$1/$2.swf\" width=\"440\" height=\"272\" wmode=\"transparent\" allowFullScreen=\"true\" allowScriptAccess=\"always\" name=\"Metacafe\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\"></embed></div>",
                // AUDIO
                // wrzuta.pl
                "#(?:[htp:/])*(\w+).wrzuta.pl/audio/(.*)/[\w]*#" => "<script type=\"text/javascript\" src=\"http://www.wrzuta.pl/embed_audio.js?key=$2&login=$1&width=450&bg=ffffff\"></script>",
                // IMAGES
                "#.*(http://[\w\.\,\/-]*(gif|png|jpg)).*#" => "<a href='$1' class='gallery'><img src='$1' class='image'></a>",
                // URL (with optional space before and/or after link, not used in any previous patterns)
                "#(.*)? ([^=\";'>]http://[\w\.\,\#\?\&=\/-]*) ?(.*)#" => "$1 <a href='$2'>$2</a> $3",
                // URL (single link in begin of <p> tag, optionally prefixed with nbsp;)
                "#(.*)?[<p>&nbsp;\/ ]?[^=\";'>](http://[\w\.\,\#\?\&=\/-]*) ?(.*)#" => "$1 <a href='$2'>$2</a> $3",
                // URL (single link in begin of <p> tag at begining of string
                "#^<p>[ &nbsp;\/]*(http://[\w\.\,\#\?\&=\/-]*)</p>#" => "<a href='$1'>$1</a>",
                // URL in the beginning of raw contents
                "#^(http://[\w\.\,\#\?\&=\/-]*) ?.*#" => "<a href='$1'>$1</a>");

        return preg_replace(array_keys($regs), array_values($regs), $text);
    }
}
