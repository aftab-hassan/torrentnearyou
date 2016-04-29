<?php

include('simple_html_dom.php');

//to parse a webpage
$html = file_get_html("http://nimishprabhu.com");

////to parse a file using relative location
//$html = file_get_html("index.html");
//
////to parse a file using absolute location
//$html = file_get_html("/home/admin/nimishprabhu.com/testfiles/index.html");
//
////to parse a string as html code
//$html = str_get_html("<html><head><title>Cool HTML Parser</title></head><body><h2>PHP Simple HTML DOM Parser</h2><p>PHP Simple HTML DOM Parser is the best HTML DOM parser in any programming language.</p></body></html>");
//
////to fetch a webpage in a string and then parse
//$data = file_get_contents("http://nimishprabhu.com"); //or you can use curl too, like me <img src="http://nimishprabhu.com/wp-content/plugins/lazy-load/images/1x1.trans.gif" data-lazy-src="http://nimishprabhu.com/wp-includes/images/smilies/simple-smile.png" alt=":)" class="wp-smiley" style="height: 1em; max-height: 1em;"><noscript><img src="http://nimishprabhu.com/wp-includes/images/smilies/simple-smile.png" alt=":)" class="wp-smiley" style="height: 1em; max-height: 1em;" /></noscript>
//// Some manipulation with the $data variable, for e.g.
//$data = str_replace("Nimish", "NIMISH", $data);
////now parsing it into html
//$html = str_get_html($data);

echo $html;

?>