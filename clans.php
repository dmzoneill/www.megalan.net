<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Clans","MegaLan.net Clans");
			
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='clans'","one");				
print $page;



$query = $stream->do_query("select * from site_clans","array");

for ($x=0;$x<count($query);$x++){

$j= 0 ;

$tmp = $query[$x];
$id = $tmp[0];
$clan = $tmp[1];
$members = explode("|",$tmp[2]);
$head = $tmp[3];
$headvice = $tmp[4];
$regdate = $tmp[5];
$homepage = $tmp[6];
$server = $tmp[7];
$ping = $tmp[8];
$gametype = $tmp[9];
$looking = $tmp[10];
$dead = $tmp[11];
$activation = $tmp[12];

$mem = count($members);


for($l=0;$l<10;$l++){
if(strlen($members[$l])<2){
$mem = $mem - 1;
}
}

if($looking==1){
$looking = "yes";
}
else {
$looking = "no";
}

$headdude = $stream->do_query("select id from site_users where username='$head'","one");
$vicedude = $stream->do_query("select id from site_users where username='$headvice'","one");

print "<br><center><table width=80% cellpadding=0  border=0 bgcolor='000000'><tr><td width=100%>
<table width=100% cellpadding=2 cellspacing=1 bgcolor='efefef' border=0><tr>
<td width=100%><font><font class=mainhead>$clan</font><br>";
print "<b>Clan Captain :</b> <a href='players.php?code=member&id=$headdude'>$head</a> <br>";
print "<b>Clan Vice Captain :</b> <a href='players.php?code=member&id=$vicedude'>$headvice</a> <br>";
print "<b>Registered :</b> $regdate <br>";
print "<b>Homepage :</b> <a href='$homepage'>$homepage</a> <br>";
print "<b>Server :</b> $server <br>";
print "<b>Looking for members :</b> $looking <br>";
print "<b>Clan Members :</b> ";
for ($t=0;$t<10;$t++){
$namer = $stream->do_query("select id from site_users where username='$members[$t]'","one");
print " <a href='players.php?code=member&id=$namer'>$members[$t]</a> ";
if($j<$mem-1){
print " | ";
$j++;
}
}
print "</td></tr></table></td></tr></table><br>";

}
		

footer();

?>