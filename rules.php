<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Rules","Megalan.net Rules");

			
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='rules'","one");				
print $page;

		

footer();

?>