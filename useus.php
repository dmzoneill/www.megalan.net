<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net","MegaLan.net");
	
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='useus'","one");				
print $page;


	

footer();

?>