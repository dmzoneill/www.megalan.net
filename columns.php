<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Columns","MegaLan.net Columns");

			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='columns'","one");				
print $page;


		

footer();

?>