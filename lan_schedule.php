<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net List","MegaLan.net List");
	
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='lan_schedule'","one");				
print $page;



print "<table width=100% cellpadding=5 cellspacing=0 border=0 bgcolor='#cccccc'><tr><td>Lan Schedule</td></tr><tr><td>";

print "<table width=100% cellpadding=4 cellspacing='1' border=0 bgcolor='cccccc'><tr>";

print "<td valign=top>";


$query = $stream->do_query("select * from lan_schedule order by game, date, time DESC","array");


for ($x=0;$x<count($query);$x++){

$tmp = $query[$x];
$id = $tmp[0];
$date = $tmp[1];
$time = $tmp[2];
$desc = $tmp[3];
$game = $tmp[4];
$ip = $tmp[5];





}



print "<tr><td bgcolor='#cccccc'><div align=right><a href='news.php?newpost=showall'>Show all Topics</a></div></td></tr>";



print "</table></td></tr></table>";



		

footer();

?>