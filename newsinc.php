</TD>
                <TD width=4>&nbsp;</TD></TR>
              <TR>
                <TD width=4>&nbsp;</TD>
                <TD colSpan=3>&nbsp;</TD>
                <TD width=4>&nbsp;</TD></TR>
              <TR>
                <TD width=4 height=22>&nbsp;</TD>
                <TD width=300 background=img/news_headl.jpg 
height=22>

<font class=mainhead><center>Latest News and Columns</center></TD>
                <TD align=middle width=4 height=22>&nbsp;</TD>
                <TD align=middle width=200
                background=img/sml_headr.jpg><font class=mainhead><center>Opinion Box</center></TD>
                <TD width=4 height=22>&nbsp;</TD></TR>
              <TR>
                <TD width=4>&nbsp;</TD>
                <TD vAlign=top borderColor=#000000 align=left width=300 
                bgColor=#cccccc><table width='100%' border='0' cellspacing='1' cellpadding='3'>


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

$que = $stream->do_query("select id from site_users where username='$poster'","one");

if($r>6){
break;
}

print "<tr><td><center><table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td bgcolor='#222222'>
<table width='100%' border='0' cellspacing='3' cellpadding='0'><tr><td>
<a class=news href='news.php?newpost=showtopic&topic=$id'> $subject </a></td></tr></table>
<table width='100%' border='0' cellspacing='0' cellpadding='5'><tr><td bgcolor='#efefef'>";
print "<font class=news> $messages <br> By <a class=body href='players.php?page=member&id=$que'>$poster </a>......<br>";
print "</td></tr></table></td></tr></table></center></td></tr>";
$r++;

}

print "<tr><td><br><a class=body href='news.php?newpost=showall'>Show all Topics</a></td></tr>";

?>
 </table>
</TD>
                <TD vAlign=top align=middle width=4>&nbsp;</TD>
<TD vAlign=top borderColor=#000000 width=200 bgColor=#cccccc>
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
$ms = $tmpg[2];
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

print "<center><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td bgcolor='#222222'><table width='100%' border='0' cellspacing='3' cellpadding='0'><tr><td><a class=news href='#'> $title </a></td></tr></table><table width='100%' border='0' cellspacing='0' cellpadding='5'><tr><td bgcolor='#efefef'>";
print "<font class=news>$date<br>$ms <br>By <a class=body href='players.php?page=member&id=$que'>$usern </a>......<br>";
print "</td></tr></table></td></tr></table></td></tr>";	  

}	
		
print "<tr><td><font><a class=foot href='shoutbox.php'>Post your Shout here!</a></td></tr></table>";		  
	  
?>
</TD>
<TD width=4>&nbsp;</TD></TR><tr><td>	