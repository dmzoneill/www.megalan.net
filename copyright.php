<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Copyright","Megalan.net Copyright");

			
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='copyright'","one");				
print $page;

		

footer();

?>