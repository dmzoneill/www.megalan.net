<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Requirements","Megalan.net Requirements");

			
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='whattobring'","one");				
print $page;

		

footer();

?>