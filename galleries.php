<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Galleries","MegaLan.net Galleries");
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='galleries'","one");				
print $page;


		

footer();

?>