<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Computer Configuration","Megalan.net Computer Configuration");

			
			
switch($page){


default:
$page = $stream->do_query("select pagecontents from site_english where pagename='pcconfig'","one");				
print $page;
break;

case "pc-windows9x":
$page = $stream->do_query("select pagecontents from site_english where pagename='pc-windows9x'","one");				
print $page;
break;

case "pc-windowsnt":
$page = $stream->do_query("select pagecontents from site_english where pagename='pc-windowsnt'","one");				
print $page;
break;

case "pc-linux":
$page = $stream->do_query("select pagecontents from site_english where pagename='pc-linux'","one");				
print $page;
break;

case "pc-windows2k":
$page = $stream->do_query("select pagecontents from site_english where pagename='pc-windows2k'","one");				
print $page;
break;

case "pc-windowsxp":
$page = $stream->do_query("select pagecontents from site_english where pagename='pc-windowsxp'","one");				
print $page;
break;

}

footer();

?>