<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Venue Directions","Megalan.net Venue Directions");

				
$page = $stream->do_query("select pagecontents from site_english where pagename='venue-directions'","one");				
print $page;


footer();

?>