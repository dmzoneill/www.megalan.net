<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");


if($printable){
sheader("MegaLan Disclaimer","MegaLan Disclaimer");
}


$page = $stream->do_query("select pagecontents from site_english where pagename='terms-conditions'","one");
print $page;
	

if($printable){
footer();
}

?>