<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Disclaimer","Megalan.net Disclaimer");

			
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='disclaimer'","one");				
print $page;

		

footer();

?>