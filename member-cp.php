<?php
// phpcs:ignoreFile
// jscpd:ignore-start

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

/* @phpstan-ignore-line */ sheader("MegaLan.net Member Control Panel","MegaLan.net Member Control Panel");


/* @phpstan-ignore-line */ if(validatecookie($msg)==1){

/* @phpstan-ignore-line */ $rank = $stream->do_query("select rank from site_users where username='$cookieuser'","one");

print "<br><center><table width=90% cellpadding=0  border=0 bgcolor='000000'><tr>
<td width=100%>
<table width=100% cellpadding=2 cellspacing=1 bgcolor='efefef' border=0><tr>
<td width=100%><font>";
print "<table cellpadding=2 width=100% cellspacing=0 border=0><tr><td valign=top>";

print "<font> General User options<br><a href='member-cp.php?control=editmaprofile'>Change / Edit my Profile</a><br>";
print "<a href='member-cp.php?control=editpass'>Change my password</a><br>";
print "<a href='shoutbox.php'>Shout Box</a><br>";
print "<a href='logout.php?step=logout'>Logout</a><br><br></td><td valign=top align=right>";

print "<font>Private Message Inbox<br><a href='member-cp.php?control=private&show=now'>Show My messages</a><br>";
print "<a href='member-cp.php?control=private&send=start'>Send Message</a><br>";
print " (no warning) <a href='member-cp.php?control=private&delete=all'>Mass Deletion</a><br>";
print "<a href='member-cp.php?control=private&buddies=now'>Buddies</a><br><br></td></tr>";

if($rank>1){
print "<tr><td><font>Clan Options<br>";
print "<a href='member-cp.php?control=regclan'>Register a Clan</a><br>";
print "<a href='member-cp.php?control=editclan'>Edit my Clan</a><br><br>";
}
if($rank>1){
print "</td><td valign=top align=right><font>Staff and Administrator Features<br>";
print "<a href='http://www.megalan.net/adminnew.php'>Administration Panel</a><br>";
print "<a href='http://www.megalan.net/news.php?newpost=postform'>Post News</a><br>";
print "<a href='http://www.megalan.net/member-cp.php?control=editnews'>Edit news posts</a><br>";
}

print "</td></tr></table></td></tr></table></td></tr></table><br>";



/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ intersection("MegaLan.net $control");






	
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ switch($control){

default:

/* @phpstan-ignore-line */ $pms = $stream->do_query("select * from site_pms where destination='$cookieuser'","array");
if(count($pms)>0){
for ($x=0;$x<count($pms);$x++){
$tmp = $pms[$x];
$id = $tmp[0];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $dest = $tmp[1];
$dep = $tmp[2];
$msg = nl2br($tmp[3]);
$time = $tmp[5];
$date = $tmp[4];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $ip = $tmp[6];
$title = $tmp[7];

/* @phpstan-ignore-line */ $cunt = $stream->do_query("select id from site_users where username='$dep'","one"); // codespell:ignore cunt

/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $bitches = $stream->do_query("update site_pms set haveread='1' where haveread='0'","one");

print "<center><table width='100%' border='0' cellspacing='1' cellpadding='1'><tr><td bgcolor='#000000'><center>";
print "<table width='100%' border='0' cellspacing='' cellpadding='3'><tr><td bgcolor='#000000'><a class=news name=shit>$title";
print "</td></tr></table>";
print "<table width='100%' border='0' cellspacing='' cellpadding='3'><tr><td width=100% bgcolor='#cccccc'>";
print "<font><b>From</b>  : $dep </b><br><b>On</b> : $time, $date<br><br>";
print "<font>$msg<br><br><a href='member-cp.php?control=private&delete=$id'>Delete</a> | <a href='http://www.megalan.net/member-cp.php?control=private&send=start&user=$cunt'>Reply to $dep</a>";
print "</td></tr></table></td></tr></table><br>";
}
}
else {
print "<font> You have 0 private messages</a>";
}
print "<br>";

break;









case "editnews":


print "<table cellpadding=3 cellspacing=0 border=0 bgcolor=''><tr><td valign=top>";
/* @phpstan-ignore-line */ $resultt = $stream->do_query("Select * from site_news where parent='0'", "array");
$num1 = count($resultt);

for($i=0;$i<$num1;$i++){

$tmp = $resultt[$i];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $id = $tmp[0];
$subject = $tmp[1];
$time = $tmp[2];
$message = $tmp[3];
$poster = $tmp[4];
$uni = $tmp[7];

print "<font><a href='member-cp.php?control=editform&edit=$uni'>$subject</a> by <b>$poster</b> on the <b>$time</b><br>";

}

print "</td></tr></table>";


break;











case "editform":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($deleteher){
if($rank>2){
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $whattime = date("j F Y");
/* @phpstan-ignore-line */ $resultt = $stream->do_query("delete from site_news where id = '$deleteher'", "one");
if($resultt!="bad"){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ print "<font>News topic deletion successfull $ok $refresh"; // codespell:ignore successfull
}
}
}

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if ($edither){
if($rank>2){
$whattime = date("j F Y");
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ $message = eregi_replace("\"","\\\"",$message);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ $message = eregi_replace("'","\'",$message);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ $resultt = $stream->do_query("UPDATE site_news set subject = '$subject', whattime = '$whattime', messages = '$message' where id = '$edither'", "one");
if($resultt!="bad"){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ print "<font>News topic update successfull $ok $refresh"; // codespell:ignore successfull
}
}
}
else {

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($edit){
/* @phpstan-ignore-line */ $resultt = $stream->do_query("Select * from site_news where uniqueid='$edit'", "array");
$num1 = count($resultt);

for($i=0;$i<$num1;$i++){

$tmp = $resultt[$i];
$id = $tmp[0];
$subject = $tmp[1];
$time = $tmp[2];
$message = $tmp[3];
$poster = $tmp[4];

print "<center><form action=\"member-cp.php?control=editform&edither=$id\" method=\"POST\">
<table width=80% cellpadding=0  border=0 bgcolor='000000'><tr>
<td width=100%>
<table width=100% cellpadding=2  border=0 bgcolor='efefef'><tr>
<td width=100%><font><b>Message : $subject  By : $poster
</td></tr><tr>
<td width=100%><font>Subject : <input class='tbox'  type=\"text\" name=\"subject\" value=\"$subject\"></td>\n
</tr>\n
<tr>\n
<td valign=top>
<font>Posted on : <input class='tbox'  type=\"text\" name=\"whattime\" value=\"$time\"></td>\n
</tr>\n
<tr>\n
<td width=100%>
<font>Message :<br> <textarea class=text cols=\"85\" rows=\"10\" name=\"message\">$message</textarea>
</td>\n
</tr><tr><td valign=top>
<table><tr><td valign=top>
<input class='tbox'  type=\"hidden\" name=\"poster\" value=\"$poster\">
<input class='tbox'  type=\"hidden\" name=\"id\" value=\"$id\">
<input class='tbox'  type=\"hidden\" name=\"edit\" value=\"edit\">
<input class='tbox'  type=\"submit\" value=\"Edit!\"></form></td><td valign=top>
<form action=\"member-cp.php?control=editform&deleteher=$id\" method=\"POST\">
<input class='tbox'  type=\"hidden\" name=\"id\" value=\"$id\">
<input class='tbox'  type=\"hidden\" name=\"droppost\" value=\"droppost\">
<input class='tbox'  type=\"submit\" value=\"Delete\"></form>
</td></tr></table></td></tr></table>
</td></tr></table><br>";

}

/* @phpstan-ignore-line */ $resultt = $stream->do_query("Select * from site_news where parent='$edit'", "array");
$num1 = count($resultt);

for($i=0;$i<$num1;$i++){
$tmp = $resultt[$i];
$id = $tmp[0];
$subject = $tmp[1];
$time = $tmp[2];
$message = $tmp[3];
$poster = $tmp[4];

print "<form action=\"member-cp.php?control=editform&edither=$id\" method=\"POST\"><table width=80% cellpadding=0  border=0 bgcolor='000000'><tr>
<td width=100%>
<table width=100% cellpadding=2 bgcolor='dddddd' border=0><tr>
<td width=100%><font><b>Message : $subject  By : $poster
</td></tr><tr>
<td width=100%><font>Subject : <input class='tbox'  type=\"text\" name=\"subject\" value=\"$subject\"></td>\n
</tr>\n
<tr>\n
<td valign=top>
<font>Posted on : <input class='tbox'  type=\"text\" name=\"whattime\" value=\"$time\"></td>\n
</tr>\n
<tr>\n
<td width=100%>
<font>Message :<br> <textarea class=text cols=\"85\" rows=\"10\" name=\"message\">$message</textarea>
</td>\n
</tr><tr><td valign=top>
<table><tr><td valign=top>
<input class='tbox'  type=\"hidden\" name=\"poster\" value=\"$poster\">
<input class='tbox'  type=\"hidden\" name=\"id\" value=\"$id\">
<input class='tbox'  type=\"hidden\" name=\"edit\" value=\"edit\">
<input class='tbox'  type=\"submit\" value=\"Edit!\"></form></td><td valign=top>
<form action=\"member-cp.php?control=editform&deleteher=$id\" method=\"POST\">
<input class='tbox'  type=\"hidden\" name=\"id\" value=\"$id\">
<input class='tbox'  type=\"hidden\" name=\"droppost\" value=\"droppost\">
<input class='tbox'  type=\"submit\" value=\"Delete\"></form>
</td></tr></table></td></tr></table>
</td></tr></table><br>";

}
}
}

break;









case "regclan":
/* @phpstan-ignore-line */ $aremem = $stream->do_query("select members from site_clans","array");
/* @phpstan-ignore-line */ $are = $stream->do_query("select head,headvice,members from site_clans where head='$cookieuser' or headvice='$cookieuser'","row");


/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($clanreg){
/* @phpstan-ignore-line */ if($are[0]!=$cookieuser){
/* @phpstan-ignore-line */ if($are[1]!=$cookieuser){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($clanvice){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($clanname){

/* @phpstan-ignore-line */ $query = $stream->do_query("select headvice,members from site_clans","array");

for ($x=0;$x<count($query);$x++){
$tmp = $query[$x];
$vice = $tmp[0];
$members = $tmp[1];
/** @psalm-suppress RiskyTruthyFalsyComparison */ if(stristr($clanvice,$vice)){
/* @phpstan-ignore-line */ die_nice("Your vice captain is already registered to a clan");
}
/** @psalm-suppress RiskyTruthyFalsyComparison */ if(stristr($clanvice,$members)){
/* @phpstan-ignore-line */ die_nice("Your vice captain is already registered to a clan");
}
}

$date = date("j, n, Y"); 
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable */ $query = $stream->do_query("INSERT INTO site_clans VALUES ('', '$clanname', '$clanmembers', '$cookieuser', '$clanvice', '$date', '$clanhomepage', '$clanserver', '$ping', '$clangametype', '$clanlooking', '0', '0')","one");
print "Well done your clan has been registered";
}
}
}
}
}

else {
/* @phpstan-ignore-line */ if($are[0]!=$cookieuser){
/* @phpstan-ignore-line */ if($are[1]!=$cookieuser){
for ($x=0;$x<count($aremem);$x++){
$tmp = $aremem[$x];
$members = $tmp[0];
/* @phpstan-ignore-line */ /** @psalm-suppress RiskyTruthyFalsyComparison */ if(stristr($members,"$cookieuser")){
/* @phpstan-ignore-line */ die_nice("<br><font><dd>Dude your already a member of a clan!<br><br>");
}
}

print "<form action=member-cp.php?control=regclan&clanreg=true method=post>";
print "<table cellpadding=3 cellspacing=0 border=0 width=100%>";
print "<tr><td valign=top><font>Clan Name :</td><td valign=top><input class='tbox' type=text name=clanname></td></tr>";
print "<tr><td valign=top><font>Clan Vice Captain :</td><td valign=top><select name=clanvice>";
print "<option value=''>---User List---</option>\n";
/* @phpstan-ignore-line */ $users = $stream->do_query("select * from site_users order by username ASC","array");
for ($x=0;$x<count($users);$x++){
$tmp = $users[$x];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $id = $tmp[0];
$username = $tmp[1];
print "<option value='$username'>$username</option>\n";
}
print "</select></td></tr>";
print "<tr><td valign=top><font>Clan Homepage :</td><td valign=top><input class='tbox' type=text name=clanhomepage></td></tr>";
print "<tr><td valign=top><font>Clan Server :</td><td valign=top><input class='tbox' type=text name=clanserver></td></tr>";
print "<tr><td valign=top><font>Clan Game Type :</td><td valign=top><input class='tbox' type=text name=clangametype></td></tr>";
print "<tr><td valign=top></td><td valign=top></td></tr>";
print "<tr><td valign=top><font>Submit Clan</td><td valign=top><input type=submit class=tbox value='Register clan'></td></tr>";
print "</table>";
print "</form>";


}
else {
print "<br><dd><font>Your Already a vice captain of a clan<br><br>";
}
}
else {
print "<br><dd><font>You've Already Registered a clan<br><br>";
}
}

break;








case "editclan":


/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$edit){
/* @phpstan-ignore-line */ $query = $stream->do_query("select * from site_clans where head='$cookieuser'","array");

for ($x=0;$x<count($query);$x++){
$tmp = $query[$x];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $id = $tmp[0];
$clan = $tmp[1];
$members = $tmp[2];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $head = $tmp[3];
$headvice = $tmp[4];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $regdate = $tmp[5];
$homepage = $tmp[6];
$server = $tmp[7];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $ping = $tmp[8];
$gametype = $tmp[9];
$looking = $tmp[10];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $dead = $tmp[11];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $activation = $tmp[12];


print "<form action=member-cp.php?control=editclan&edit=true method=post>";
print "<table cellpadding=3 cellspacing=0 border=0 width=100%>";
print "<tr><td valign=top><font>Clan Name :</td><td valign=top><input class='tbox' type=text name=clanname value='$clan'></td></tr>";
print "<tr><td valign=top><font>Vice Captain :</td><td valign=top><input class='tbox' type=text name=clanvice value='$headvice'></td></tr>";
print "<tr><td valign=top><font>Clan Homepage :</td><td valign=top><input class='tbox' type=text name=clanhomepage value='$homepage'></td></tr>";
print "<tr><td valign=top><font>Clan Server :</td><td valign=top><input class='tbox' type=text name=clanserver value='$server'></td></tr>";
print "<tr><td valign=top><font>Clan Game Type :</td><td valign=top><input class='tbox' type=text name=clangametype value='$gametype'></td></tr>";
print "<tr><td valign=top><font>Looking for members :</td><td valign=top><input class='tbox' type=checkbox ";
if($looking==1){
print "checked";
}
print " name=lookingfor></td></tr>";

$shit = explode("|",$members);


for($h=1;$h<11;$h++){
$p = $h -1;
print "<tr><td valign=top><font>Member $h</td><td valign=top><input class='tbox' type=text name=member$p value='$shit[$p]'></td></tr>";
}


print "<tr><td valign=top><font>Submit Clan</td><td valign=top><input type=submit class=tbox value='Edit Ma clan'></td></tr>";
print "</table>";
print "</form>";

}
}


if($edit) {

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($lookingfor){
$looking = 1;
}

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ $bitchfaces = "$member0|$member1|$member2|$member3|$member4|$member5|$member6|$member7|$member8|$member9";

/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable, PossiblyUndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable */ $bitches = $stream->do_query("update site_clans set clan='$clanname', headvice='$clanvice', homepage='$clanhomepage', server='$clanserver', gametype='$clangametype', looking='$looking', members='$bitchfaces' where head='$cookieuser'","one");

print "<font> Clan updated!";

}

break;





case "private":
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($doit=="send"){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($buddiesyeah){
if($rank<3){
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable */ $subject = htmlspecialchars($subject);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ $message = htmlspecialchars($message);
}
if($rank>2){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ $message = eregi_replace("\"","\\\"",$message);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ $message = eregi_replace("'","\'",$message);
}
$date = date("j, n, Y"); 
$time = date("g:i a"); 
/* @phpstan-ignore-line */ $bitches = $stream->do_query("select buddies from site_users where username='$cookieuser'","one");
$bitch = explode("|",$bitches);
$fuckbitches = count($bitch);
/* @phpstan-ignore-line */ intersection("Sending message to your buddies");
for($y=0;$y<$fuckbitches;$y++){
/* @phpstan-ignore-line */ /** @psalm-suppress PossiblyUndefinedGlobalVariable, UndefinedGlobalVariable */ $guery = $stream->do_query("insert into site_pms values('','$bitch[$y]','$cookieuser','$message','$time','$date','$iptrack','$title','0')","one");
if($guery!="bad"){
print "<font> $bitch[$y] has received your message<br>";
}
}

}
else {
if($rank<3){
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable */ $subject = htmlspecialchars($subject);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ $message = htmlspecialchars($message);
}
if($rank>2){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ $message = eregi_replace("\"","\\\"",$message);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ $message = eregi_replace("'","\'",$message);
}
$date = date("j, n, Y"); 
$time = date("g:i a"); 
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable, PossiblyUndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable */ $query = $stream->do_query("insert into site_pms values('','$destination','$cookieuser','$message','$time','$date','$iptrack','$title','0')","one");
print "Message sent successfully";
}

}



/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ elseif($send){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($user){
/* @phpstan-ignore-line */ $user = $stream->do_query("select username from site_users where id='$user'","one");
}
print "<center><br><table border=0 width=95%><tr>";
print "<form action='member-cp.php?control=private&doit=send' method=post>";
print "<td valign=top><font>Title : </td><td valign=top><input class='tbox'  type=text name=title></td></tr>";
print "<tr><td valign=top><font>Mesage : </td><td valign=top><textarea  class='text' rows=8 cols=50 name=message></textarea></td></tr>"; // codespell:ignore mesage
if(!$user){
print "<tr><td valign=top><font>Send to : </td><td valign=top><select name='destination'>";
print "<option value=''>---User List---</option>\n";
/* @phpstan-ignore-line */ $users = $stream->do_query("select * from site_users where rank>0 order by username ASC","array");
for ($x=0;$x<count($users);$x++){
$tmp = $users[$x];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $id = $tmp[0];
$username = $tmp[1];
print "<option value='$username'>$username</option>\n";
}
print "</select></td></tr>";
print "<tr><td valign=top><font>Send to Buddies : </td><td valign=top><input class='tbox' type=checkbox name='buddiesyeah'> <a href='http://www.megalan.net/member-cp.php?control=private&buddies=now'> My buddies </a></td></tr>";

}
if($user){
print "<tr><td valign=top><font>Send to : </td><td valign=top><font><b>$user</b><input class='tbox' type=hidden name=destination value='$user'><br><br></td></tr>";
}
print "<tr><td valign=top><font>Send :</td><td valign=top>";
print "<input class='tbox' type=submit value=Send>";
print "</form>";
print "</td></tr></table><br>";
}




/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ elseif($show){
/* @phpstan-ignore-line */ $pms = $stream->do_query("select * from site_pms where destination='$cookieuser'","array");
if(count($pms)>0){
for ($x=0;$x<count($pms);$x++){
$tmp = $pms[$x];
$id = $tmp[0];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $dest = $tmp[1];
$dep = $tmp[2];
$msg = $tmp[3];
$time = $tmp[5];
$date = $tmp[4];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $ip = $tmp[6];
$title = $tmp[7];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $haveread = $tmp[8];

/* @phpstan-ignore-line */ $cunt = $stream->do_query("select id from site_users where username='$dep'","one"); // codespell:ignore cunt
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $bitches = $stream->do_query("update site_pms set haveread='1' where haveread='0'","one");


print "<center><table width='100%' border='0' cellspacing='1' cellpadding='1'><tr><td bgcolor='#000000'><center>";
print "<table width='100%' border='0' cellspacing='' cellpadding='3'><tr><td bgcolor='#000000'><a class=news name=shit>$title";
print "</td></tr></table>";
print "<table width='100%' border='0' cellspacing='' cellpadding='3'><tr><td bgcolor='#cccccc'>";
print "<font><b>From</b>  : $dep </b><br><b>On</b> : $time, $date<br><br>";
print "<font>$msg<br><br><a href='member-cp.php?control=private&delete=$id'>Delete</a> | <a href='http://www.megalan.net/member-cp.php?control=private&send=start&user=$cunt'>Reply to $dep</a>";
print "</td></tr></table></td></tr></table><br>";
}
}
else {
print "<font> You have 0 private messages</a>";
}
print "<br>";
}



/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ elseif($delete){
if($delete!="all"){
/* @phpstan-ignore-line */ $check = $stream->do_query("select destination from site_pms where id='$delete'","one");
/* @phpstan-ignore-line */ if($check==$cookieuser){
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $query = $stream->do_query("delete from site_pms where id='$delete'","one");
print "<font>Message Deleted Successfully";
}
else {
print "<font>Unauthorised message delete attempted and logged"; 
}
}
if($delete=="all"){
/* @phpstan-ignore-line */ intersection("Mass message deletion!");
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $query = $stream->do_query("delete from site_pms where destination='$cookieuser'","one");
print "<font>All messages deleted successfully";
}
}




/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ elseif($buddies){
/* @phpstan-ignore-line */ $query = $stream->do_query("select buddies from site_users where username='$cookieuser'","one");
$buddies = explode("|",$query);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($foo){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ $dudes = "$buddie1|$buddie2|$buddie3|$buddie4|$buddie5|$buddie6|$buddie7|$buddie8|$buddie9|$buddie10";
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $queryy = $stream->do_query("update site_users set buddies='$dudes' where username='$cookieuser'","one");
print "<font>buddies Updated<br><br>"; 
}
print "<form action='member-cp.php?control=private&buddies=true&foo=true' method=post>";
for($f=1;$f<11;$f++){
$g = $f -1;
print "<font>buddie $f <input class='tbox'  type=text name='buddie$f' value='$buddies[$g]'><br>";
}
print "<input class='tbox'  type=submit value='Update Buddie List'></form>";
}



else {
/* @phpstan-ignore-line */ $pms = $stream->do_query("select * from site_pms where destination='$cookieuser'","array");
if(count($pms)>0){
for ($x=0;$x<count($pms);$x++){
$tmp = $pms[$x];
$id = $tmp[0];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $dest = $tmp[1];
$dep = $tmp[2];
$msg = $tmp[3];
$time = $tmp[5];
$date = $tmp[4];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $ip = $tmp[6];
$title = $tmp[7];
print "<center><table width='100%' border='0' cellspacing='1' cellpadding='1'><tr><td bgcolor='#000000'><center>";
print "<table width='100%' border='0' cellspacing='' cellpadding='3'><tr><td bgcolor='#000000'><a class=news name=shit>$title";
print "</td></tr></table>";
print "<table width='100%' border='0' cellspacing='' cellpadding='3'><tr><td bgcolor='#cccccc'>";
print "<font><b>From</b>  : $dep </b><br><b>On</b> : $time, $date<br><br>";
print "<font>$msg<br><br><a href='member-cp.php?control=private&delete=$id'>Delete</a>";
print "</td></tr></table></td></tr></table><br>";
}
}
else {
print "<font> You have 0 private messages</a>";
}
print "<br>";
}

break;











case "editmaprofile":
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$edit){

/* @phpstan-ignore-line */ $query = $stream->do_query("select * from site_users where username='$cookieuser'","array");
for ($x=0;$x<count($query);$x++){
$tmp = $query[$x];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $id = $tmp[0];
$name = $tmp[2];
$age = $tmp[4];
$dob = explode("-",$tmp[5]);
$address = $tmp[6];
$telephone = $tmp[7];
$country = $tmp[8];
$county = $tmp[9];
$email = $tmp[11];
$other = $tmp[10];
$yahoo = $tmp[12];
$msn = $tmp[13];
$irc = $tmp[14];
$icq = $tmp[15];
$aim = $tmp[16];
$mailinglist = $tmp[17];
$picture = $tmp[22];
print "<table cellpadding=0 cellspacing=0 border=0 width=90%>";
print "<form action='member-cp.php?control=editmaprofile&edit=true' method='post'>";
print "<tr><td valign=top><font>Name :</td><td valign=top><input class='tbox'  type='text' name='name' value='$name'></td></tr>";
print "<tr><td valign=top><font>Age :</td><td valign=top><select name=age>";


for($k=100;$k>7;$k--){
print "<option class='tbox' ";
if($k==$age){
print "selected";
}
print " value='$k'>$k";
}

print "</select></td></tr>";
print "<tr><td valign=top><font>Date of Birth :</td><td valign=top>";


?>

<select name=day>

<script language=javascript>

for (x=1;x<33;x++){
<?php
print "var dob1 = $dob[0];\n";
?>
document.write("<option ");
if(x==dob1){
var yeah = "selected";
}
else {
var yeah = "";
}
document.write(yeah + " value='" + x + "'>" + x + "</option>");

}

</script>

</select> - 

<select name=month>

<script language=javascript>

for (x=1;x<13;x++){
<?php
print "var dob2 = $dob[1];\n";
?>
document.write("<option ");
if(x==dob2){
var yeah = "selected";
}
else {
var yeah = "";
}
document.write(yeah + " value='" + x + "'>" + x + "</option>");

}

</script>

</select> - 

<select name=year>

<script language=javascript>

for (x=1996;x>1900;x--){
<?php
print "var dob3 = $dob[2];\n";
?>
document.write("<option ");
if(x==dob3){
var yeah = "selected";
}
else {
var yeah = "";
}
document.write(yeah + " value='" + x + "'>" + x);

}

</script>

</select>

<br><br>


<?php

print "</td></tr>";
print "<tr><td valign=top><font>Address :</td><td valign=top><textarea  class='text' cols=60 rows=8 name='address'>$address</textarea></td></tr>";
print "<tr><td valign=top><font>Telephone :</td><td valign=top><input class='tbox'  type='text' name='telephone' value='$telephone'></td></tr>";
print "<tr><td valign=top><font>Country :</td><td valign=top><input class='tbox'  type='text' name='country' value='$country'></td></tr>";
print "<tr><td valign=top><font>County :</td><td valign=top><input class='tbox'  type='text' name='county' value='$county'></td></tr>";
print "<tr><td valign=top><font>Other  :</td><td valign=top><input class='tbox'  type='text' name='other' value='$other'></td></tr>";
print "<tr><td valign=top><font>Email :</td><td valign=top><input class='tbox'  type='text' name='email' value='$email'></td></tr>";
print "<tr><td valign=top><font>Yahoo id :</td><td valign=top><input class='tbox'  type='text' name='yahoo' value='$yahoo'></td></tr>";
print "<tr><td valign=top><font>MSN id :</td><td valign=top><input class='tbox'  type='text' name='msn' value='$msn'></td></tr>";
print "<tr><td valign=top><font>Irc Handle :</td><td valign=top><input class='tbox'  type='text' name='irc' value='$irc'></td></tr>";
print "<tr><td valign=top><font>Icq number :</td><td valign=top><input class='tbox'  type='text' name='icq' value='$icq'></td></tr>";
print "<tr><td valign=top><font>Aol Instant messenger :</td><td valign=top><input class='tbox'  type='text' name='aim' value='$aim'></td></tr>";

if($mailinglist==1){
$t1 = "selected";
$t2 = "";
}
else {
$t1 = "";
$t2 = "selected";
}

print "<tr><td valign=top><font>Mailing List :</td><td valign=top>
<select name='mailing'>
<option class='tbox' $t1 value='1'>Yes
<option class='tbox' $t2 value='1'>No
</select>
</td></tr>";


print "<tr><td valign=top><font>Picture Location :</td><td valign=top><input class='tbox'  type='text' name='pic' value='$picture'><br><br></td></tr>";
print "<tr><td valign=top><font>All done?</td><td valign=top><input class='tbox'  type=submit value='Edit ma Profile'></td></tr>";
print "</form></table>";
}
}
if($edit){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ $dob = "$day - $month - $year";
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ $address = eregi_replace("\"","\\\"",$address);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ $address = eregi_replace("'","\'",$address);
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, PossiblyUndefinedGlobalVariable, UndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable */ $query = $stream->do_query("update site_users set name='$name', age='$age', dob='$dob', address='$address', aim='$aim', mailinglist='$mailing', email='$email', yahoo='$yahoo', msn='$msn', irc='$irc', icq='$icq',  telephone='$telephone', country='$country', county='$county', other='$other', picture='$pic' where username='$cookieuser'","one");
print "Well done, you've updated your profile";
}
break;



case "editpass":
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($passchange){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ $old = md5($old);
/* @phpstan-ignore-line */ $oldpass = $stream->do_query("select password from site_users where username='$cookieuser'","one");
if($old==$oldpass){
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ if($pass1==$pass2){
/** @psalm-suppress UndefinedGlobalVariable */ $pas = md5($pass2);
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $oldpass = $stream->do_query("update site_users set password='$pas' where username='$cookieuser'","one");
/** @psalm-suppress UndefinedGlobalVariable */ print "<font> Password successfully changed to $pass1<br><br>";
$cookie_domain = '.megalan.net'; 
$cookiecontents = "no";
$timer = time()-3600;
/* @phpstan-ignore-line */ $cookie = explode("|",$goodcookie);
$cookieuser = $cookie[1];
setcookie("goodcookie", $cookiecontents, time()-3600, "/", $cookie_domain);
/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $update = $stream->do_query("update site_users set loggedin='0', loggedtime='$timer' where username='$cookieuser'","one");	 

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ login("member-cp.php",$fail);

}
else {
print "<font> Your new password did not match the confirmed password<br><br>";
}
}
else {
print "<font> Your old password did not match the one in the database<br><br>";
}
}

else {

print "<table cellpadding=3 cellspacing=0 border=0 width=100%>";
print "<form action=member-cp.php?control=editpass&passchange=true method=post>";
print "<tr><td valign=top><font> Old Password : </td><td valign=top><input class='tbox' type=password name=old></td></tr>";
print "<tr><td valign=top><font> New Password : </td><td valign=top><input class='tbox' type=password name=pass1></td></tr>";
print "<tr><td valign=top><font> Confirm Password : </td><td valign=top><input class='tbox' type=password name=pass2></td></tr>";
print "<tr><td valign=top><font> Change : </td><td valign=top><input class='tbox' type=submit value='Change My Password'></td></tr>";
print "</table>";
}
break;










}


}
else {
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ login("member-cp.php",$fail);
}


/* @phpstan-ignore-line */ footer();

?>
<?php // jscpd:ignore-end ?>
