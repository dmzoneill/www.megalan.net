<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net News","Megalan.net News");

			
			

switch($newpost){











case "postdone":

$pword = $stream->do_query("select password from site_users where username='$useralias'","one");
$rank = $stream->do_query("select rank from site_users where username='$useralias'","one");
$userpass = md5($userpass);


if($rank<3){
$subject = htmlspecialchars($subject);
$post = htmlspecialchars($post);
$post = substr("$post", 0,600)."...";
}
if($rank>2){
$post = eregi_replace("\"","\\\"",$post);
$post = eregi_replace("'","\'",$post);
}


if(!$parent){
if($rank>3){
if($pword==$userpass){
$timeit = date("D M j G:i:s T Y");
$ip = $REMOTE_ADDR;
$uniqueid = md5("$timeit");
$sql = $stream->do_query("INSERT INTO site_news VALUES ('','$subject','$timeit','$post','$useralias','0','$ip','$uniqueid')", "one");
print "<font>New Post Successfully done";
}

else {
print "<font>Password incorrect";
}
}
else {
print "<font>Not enough priveledges";
}
}

if($parent){
if($pword==$userpass){
if($rank>0){
$timeit = date("F j, Y");
$ip = $iptrack;
$uniqueid = md5("$timeit");
$sql = $stream->do_query("INSERT INTO site_news VALUES ('','$subject','$timeit','$post','$useralias','$parent','$ip','$uniqueid')", "one");
print "<font>Reply Successfully done";
}
else {
print "<font>Password dosent match";
}
}
}

break;













case "postform":

print "<br><center><table width=80% cellpadding=0  border=0 bgcolor='000000'><tr>
<td width=100%>";
if(!$parentid){
print "<table cellpadding='3' cellspacing=1 border='0' bgcolor='#efefef' width='100%'>";
print "<form action='news.php?newpost=postdone' method='post'>";
print "<tr><td><font>Username : </td><td><input class='tbox'  type='text' name='useralias'></td></tr>";
print "<tr><td><font>Password : </td><td><input class='tbox'  type='password' name='userpass'></td></tr>";
print "<tr><td><font>Subject : </td><td><input class='tbox'  type='text' name='subject'></td></tr>";
print "<tr><td><font>Message : </td><td><textarea class='text' cols=60 rows=8 name='post'></textarea></td></tr>";
print "<tr><td><font>Finshed ? </td><td><input class='tbox'  type=submit value='Post Message'></td></tr>";
print "</form></table>";
}
else{
print "<table cellpadding='3' cellspacing=1 border='0' bgcolor='#efefef' width='100%'>";
print "<form action='news.php?newpost=postdone&parent=$parentid' method='post'>";
print "<tr><td><font>Username : </td><td><input class='tbox'  type='text' name='useralias'></td></tr>";
print "<tr><td><font>Password : </td><td><input class='tbox'  type='password' name='userpass'></td></tr>";
print "<tr><td><font>Subject : </td><td><input class='tbox'  type='text' name='subject'></td></tr>";
print "<tr><td><font>Message : </td><td><textarea class='text' cols=60 rows=8 name='post'></textarea></td></tr>";
print "<tr><td><font>Finshed ? </td><td><input class='tbox'  type=submit value='Post Message'></td></tr>";
print "</form></table>";

}

print "</td></tr></table><br>";

break;








case "showtopic":


print "<table width='100%' border='0' cellspacing='1' cellpadding='3'><tr><td>";

if($topic){
$query = $stream->do_query("select * from site_news where id='$topic'","array");

for ($x=0;$x<count($query);$x++){
$tmp = $query[$x];
$id = $tmp[0];
$subject = $tmp[1];
$whattime = $tmp[2];
$messages = nl2br($tmp[3]);
$poster = $tmp[4];
$parent = $tmp[5];
$ip = $tmp[6];
$uniqueid = $tmp[7];

$messages = smilies($messages); 

$userto = $stream->do_query("select id from site_users where username='$poster'","one");

print "<center>
<table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td bgcolor='#222222'>
<table width='100%' border='0' cellspacing='3' cellpadding='0'><tr><td><a class=news href='news.php?newpost=showtopic&topic=$id'> $subject </a></td></tr></table>
<table width='100%' border='0' cellspacing='0' cellpadding='5'><tr><td bgcolor='#efefef'>";
print "<font class=news></font><font> $messages <br> By <a class=body href='players.php?code=member&id=$userto'>$poster </a>......<br><br>";





$query2 = $stream->do_query("select * from site_news where parent='$uniqueid' order by id ASC","array");
if($query2>0){
$g=0;
print "<table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td bgcolor='#222222'>
<table width='100%' border='0' cellspacing='3' cellpadding='0'><tr><td><a class=news href='#'> Comments : </a></td></tr></table>";
for ($p=0;$p<count($query2);$p++){
print "<table width='100%' border='0' cellspacing='0' cellpadding='5'><tr><td bgcolor='#dddddd'>";
$tmp1 = $query2[$p];
$id1 = $tmp1[0];
$subject1 = $tmp1[1];
$whattime1 = $tmp1[2];
$messages = nl2br($tmp1[3]);
$poster1 = $tmp1[4];
$parent1 = $tmp1[5];
$ip1 = $tmp[6];
$uniqueid1 = $tmp[7];

$messages = smilies($messages); 

$userto = $stream->do_query("select id from site_users where username='$poster1'","one");

print "<font> - > <a class=news href='#'>$subject1</a> by <a class=body href='players.php?code=member&id=$userto'>$poster1</a><br>&nbsp;&nbsp;&nbsp;&nbsp;On the $whattime1<br><br></font><font>$messages1<br>";
$g++;
print "</td></tr></table>";
}
print "</td></tr></table><br>";
}








print "<font><a href='news.php?newpost=postform&parentid=$uniqueid'>Post Reply To Message</a><br>Ip : <a href=''>Logged</a>";

print "</td></tr></table><br>";
print "</td></tr></table><br>";
}
}






print "</td></tr></table><br>";

break;


















default:

print "<table width='100%' border='0' cellspacing='1' cellpadding='3'>";

$query = $stream->do_query("select * from site_news where parent='0' order by id desc","array");

if(count($query)<1){
print "<font>No news topics!";
}

$r = 0;
for ($x=0;$x<count($query);$x++){
$tmp = $query[$x];
$id = $tmp[0];
$subject = $tmp[1];
$whattime = $tmp[2];
$messages = $tmp[3];
$poster = $tmp[4];
$parent = $tmp[5];
$ip = $tmp[6];
$uniqueid = $tmp[7];

$userto = $stream->do_query("select id from site_users where username='$poster'","one");


$messages = eregi_replace(";-\)","<img src='http://www.megalan.net/phpbb/images/smiles/icon_wink.gif'>",$messages);
$messages = eregi_replace(";\)","<img src='http://www.megalan.net/phpbb/images/smiles/icon_wink.gif'>",$messages);
$messages = eregi_replace(":\|","<img src='http://www.megalan.net/phpbb/images/smiles/icon_neutral.gif'>",$messages);
$messages = eregi_replace(":/","<img src='http://www.megalan.net/phpbb/images/smiles/icon_neutral.gif'>",$messages);
$messages = eregi_replace(":x","<img src='http://www.megalan.net/phpbb/images/smiles/icon_mad.gif'>",$messages);
$messages = eregi_replace(":wink:","<img src='http://www.megalan.net/phpbb/images/smiles/icon_wink.gif'>",$messages);
$messages = eregi_replace(":twisted:","<img src='http://www.megalan.net/phpbb/images/smiles/icon_twisted.gif'>",$messages);
$messages = eregi_replace(":smile:","<img src='http://www.megalan.net/phpbb/images/smiles/icon_eek.gif'>",$messages);
$messages = eregi_replace(":shock:","<img src='http://www.megalan.net/phpbb/images/smiles/icon_eek.gif'>",$messages);
$messages = eregi_replace(":roll:","<img src='http://www.megalan.net/phpbb/images/smiles/icon_rolleyes.gif'>",$messages);
$messages = eregi_replace(":razz:","<img src='http://www.megalan.net/phpbb/images/smiles/icon_razz.gif'>",$messages);
$messages = eregi_replace(":p","<img src='http://www.megalan.net/phpbb/images/smiles/icon_razz.gif'>",$messages);
$messages = eregi_replace(":D","<img src='http://www.megalan.net/phpbb/images/smiles/icon_biggrin.gif'>",$messages);
$messages = eregi_replace(":\)","<img src='http://www.megalan.net/phpbb/images/smiles/icon_smile.gif'>",$messages);
$messages = eregi_replace(":o","<img src='http://www.megalan.net/phpbb/images/smiles/icon_surprised.gif'>",$messages);
$messages = eregi_replace(":\(","<img src='http://www.megalan.net/phpbb/images/smiles/icon_sad.gif'>",$messages);
$messages = eregi_replace("wtf","<img src='http://www.megalan.net/phpbb/images/smiles/icon_surprised.gif'>",$messages);
$messages = eregi_replace("lol","<img src='http://www.megalan.net/phpbb/images/smiles/icon_lol.gif'>",$messages);


$r++;

if($r%2>0){
$bgcolor = "#bbbbbb";
}
else {
$bgcolor = "#cccccc";
}
print "<tr><td><center><table width='100%' border='0' cellspacing='0' cellpadding='1'><tr><td bgcolor='#222222'>
<table width='100%' border='0' cellspacing='3' cellpadding='0'><tr><td>
<a class=news href='news.php?newpost=showtopic&topic=$id'> $subject </a></td></tr></table>
<table width='100%' border='0' cellspacing='0' cellpadding='5'><tr><td bgcolor='#efefef'>";


print "<font class=news>$whattime<br></font><font>$messages<br><br>By <b><a class=body href='players.php?code=member&id=$userto'>$poster </a></b>......<br>";

$query2 = $stream->do_query("select * from site_news where parent='$uniqueid'","array");
$numposts = count($query2);

print "<br><br>";
if ($numposts>0){
print "<a href='news.php?newpost=showtopic&topic=$id'> Show all replies to this message </a>";
}
else {
print "";
}
print "<div align=right><a href='news.php?newpost=postform&parentid=$uniqueid'>Post Reply To Message</a><br>Ip :</b> <a href=''>Logged</a></div>";
print "</td></tr></table></td></tr></table></center>";
}

print "</td></tr></table>";

break;





}


footer();

?>