<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Accomodation @ the venue","Accomodation @ the venue");

			
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='accomodation'","one");				
print $page;

		

footer();

?>