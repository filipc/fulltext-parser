Fulltext parser
===============

PHP class used to replace http links with suitable player or html tags.

Case
====
Let's say you have text field in database and want to display user-friendly content in browser.
You don't want to keep in database external web players html code implementations. There is really not wise to keep everything in separate database fields - because you don't know how many links will there be. Relations are not good idea in this case, too.

Solution
========

Parse content with Fulltext Parser class that will:
- change Youtube, Vimeo, Wrzuta, Myspace, Megavideo, DailyMotion, Metacafe to relevant player.
- change Wrzuta audio to suitable audio player
- embed image links to <a> tags and add them css class
- simple html links will be changed to relevant clickable <a> tag 

Profit
======
- All links are simply in text field in database
- No vendor's html code in our database; Resistance to external html changes.
- Really fast because of regular expressions usage

PHPUnit tests included
