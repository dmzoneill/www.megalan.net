<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Attendance List","MegaLan.net Attendance List");
	
				
				
$page = $stream->do_query("select pagecontents from site_english where pagename='lists'","one");				
print $page;


$query1 = $stream->do_query("select * from site_lansignup order by id, username, payedmonies","array");
$notconfirmed = count($stream->do_query("select * from site_lansignup","array"));
$confirmed = count($stream->do_query("select * from site_lansignup where payedmonies='1'","array"));
$less = $notconfirmed - $confirmed;

if(count($query1)<1){
print "<font>Awaiting Registrants<br><br>";
}

else {

print "
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
  <tr>
    <td><center><font>
<B>$confirmed</b> of <b>$notconfirmed</b> confirmed (awaiting payment from $less registrants) / <B>150</b>
</td></tr></table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
  <tr>
    <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
  <tr>
    <td><font><b>Megalan Member</td>
    <td><font><b>Signed up Date </td>
	<td><font><b>Payment Status</td>
  </tr>";



for ($x=0;$x<count($query1);$x++){
$tmp = $query1[$x];
$id = $tmp[0];
$username = $tmp[1];
$name = $tmp[2];
$time = $tmp[14];
$payed = $tmp[12];
$hhhh = $stream->do_query("select id from site_users where username='$username'","one");
if($payed==1){
$payed = "<img src='http://www.megalan.net/img/confirmed.gif' border=0>";
}
else {
$payed = "";
}



print "<tr><td><font><a href='players.php?code=member&id=$hhhh'>$username</a> ($name) </td><td><font> ($time)</td><td> $payed </td></tr>";
}





if(count($query1)>150){
print "<tr><td colspan=3><center><HR>Next on the list<hr></td></tr>";

for ($x=151;$x<153;$x++){
$tmp = $query1[$x];
$id = $tmp[0];
$username = $tmp[1];
$name = $tmp[2];
$time = $tmp[14];
$payed = $tmp[12];
$hhhh = $stream->do_query("select id from site_users where username='$username'","one");
if($payed==1){
$payed = "<img src='http://www.megalan.net/img/confirmed.gif' border=0>";
}
else {
$payed = "";
}
print "<tr><td><font><a href='players.php?code=member&id=$hhh'>$username</a> ($name) </td><td><font> ($time)</td><td> $payed </td></tr>";
}
}


print "</table></td></tr></table>";
}
	

footer();

?>