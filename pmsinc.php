<?php

$num = count($stream->do_query("select * from site_pms where destination='$cookieuser' and haveread<1 order by id DESC","array"));
print "<font>Hey <b>$cookieuser</b>, you have <i>$num</i> new messages in your inbox<br>";
if($num>5){
$num =5;
} 
if($num>0){

print "<EMBED SRC=ringin.wav AUTOSTART=true LOOP=FALSE WIDTH=0 HEIGHT=0 ALIGN=CENTER></EMBED>";
print "Here are your lastest messages<br>";

$query = $stream->do_query("select * from site_pms where destination='$cookieuser' and haveread<1 order by id DESC","array");

for ($g=0;$g<count($query);$g++){
$tmp = $query[$g];
$id = $tmp[0];
$destination = $tmp[1];
$departure = $tmp[2];
$messages = $tmp[3];
$time = $tmp[4];
$date = $tmp[5];
$ip = $tmp[6];
$title = $tmp[7];
print "<b><a href='member-cp.php'> $title</a></b> from <i>$departure</i> on the $date @ $time.<br>";
}
}

?>