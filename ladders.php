<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Ladders","MegaLan.net Ladders");
		
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='ladders'","one");				
print $page;




		

footer();

?>