<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net News","MegaLan.net News");

			
				
				

$page = $stream->do_query("select pagecontents from site_english where pagename='about'","one");				
print $page;


		

footer();

?>