<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Web Tournaments","Megalan.net Web Tournaments");

			
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='tournaments'","one");				
print $page;

		

footer();

?>