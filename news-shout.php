<table width='100%' border='0' cellspacing='1' cellpadding='3'><tr><td width=65% valign=top><center><font><img src=img/images.jpg border=0></font>
<table width='100%' border='0' cellspacing='1' cellpadding='3'>


<?php

$query = $stream->do_query("select * from site_news where parent='0' order by id DESC","array");

$r = 0;

for ($x=0;$x<count($query);$x++){
$tmp = $query[$x];
$id = $tmp[0];
$subject = $tmp[1];
$whattime = $tmp[2];
$messages = substr("$tmp[3]", 0,160)."...";
$poster = $tmp[4];
$parent = $tmp[5];
$ip = $tmp[6];
$uniqueid = $tmp[7];


$messages = smilies($messages);

$que = $stream->do_query("select id from site_users where username='$poster'","one");

if($r>6){
break;
}

print "<tr><td><center><table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td bgcolor='#222222'>
<table width='100%' border='0' cellspacing='3' cellpadding='0'><tr><td>
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td>
<a class=news href='news.php?newpost=showtopic&topic=$id'> $subject </a></td><td align=right><font class=body>$whattime</td></tr></table></td></tr></table>
<table width='100%' border='0' cellspacing='0' cellpadding='5'><tr><td bgcolor='#efefef'>";
print "<font> $messages <br> By <a class=body href='players.php?code=member&id=$que'>$poster </a>......<br>";
print "</td></tr></table></td></tr></table></center></td></tr>";
$r++;

}

if(count($query)<1){
print "<font>No news topics!<br><a class=body href='member-cp.php'>Post a news topic!</a>";
}
else {
print "<tr><td><br><a class=body href='news.php?newpost=showall'>Show all Topics</a><br><font></td></tr>";
}

?>
 </table>


</td><td width=35% valign=top><center><img src=img/humble-opinion.gif border=0>


<table width='100%' border='0' cellspacing='1' cellpadding='3'>
				                 
				  <?php
				  
				  $sql3 = $stream->do_query("select * from site_shoutbox order by id desc","array");
				  
				  for($f=0;$f<count($sql3);$f++){
				  
				  if($f>4){
				  break;
				  }
				  
$tmpg = $sql3[$f];
$id = $tmpg[0];
$usern = $tmpg[1];
$messages = $tmpg[2];
$date = $tmpg[3];
$ip = $tmpg[4];
$title = $tmpg[5];

$ms = eregi_replace("&amp;nbsp;"," ",$ms);

if($f%2>0){
$bg = "999999";
}
else {
$bg = "cccccc";
}

 
$messages = smilies($messages); 


$que = $stream->do_query("select id from site_users where username='$usern'","one");

print "<center><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td bgcolor='#222222'><table width='100%' border='0' cellspacing='3' cellpadding='0'><tr><td><font class=news> $title </a></td></tr></table><table width='100%' border='0' cellspacing='0' cellpadding='5'><tr><td bgcolor='#dddddd'>";
print "<font class=news>$date<br></font><font>$messages <br>By <a class=body href='players.php?code=member&id=$que'>$usern </a>......<br>";
print "</td></tr></table></td></tr></table></td></tr>";	  

}	

if(count($sql3)<1){
print "<font>There are curently no shouts!!<br>";
}
print "<tr><td><font><a class=body href='shoutbox.php'>Post your Shout here!</a></td></tr></table>";		  
	  
?>

</td></tr></table>