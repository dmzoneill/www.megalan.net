<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Advertise With Megalan.net","Megalan.net Advertisements");

			
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='advertise'","one");				
print $page;

		

footer();

?>