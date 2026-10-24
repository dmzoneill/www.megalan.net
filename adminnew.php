<?php
// phpcs:ignoreFile
// jscpd:ignore-start

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");


/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$printable){
/* @phpstan-ignore-line */ sheader("MegaLan.net Administration Panel","MegaLan.net Administration Panel");
}
	
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $rank = $stream->do_query("select rank from site_users where username='$cookieuser'","one");
	
/* @phpstan-ignore-line */ if((validatecookie($msg)==1) && ($rank>4)){


$adminmenu= "

<font size=1 face=verdana><b>Add Pages :</b></font> <br>
&nbsp;&nbsp;<a href='adminnew.php?page=addpage'>Add Page</a><br>

<font size=1 face=verdana><b>Edit Pages :</b></font><br>
&nbsp;&nbsp;<a href='adminnew.php?'>Edit Pages</a><br>

<font size=1 face=verdana><b>Edit Theme :</b></font> <br>
&nbsp;&nbsp;<a href='adminnew.php?page=edit&what=19'>Edit Header</a> | 
&nbsp;&nbsp;<a href='adminnew.php?page=edit&what=20'>Edit Footer</a> | 
&nbsp;&nbsp;<a href='adminnew.php?page=edit&what=30'>Edit Menu (left)</a> | 
&nbsp;&nbsp;<a href='adminnew.php?page=edit&what=23'>Edit adds(right)</a> | 
&nbsp;&nbsp;<a href='adminnew.php?page=edit&what=21'>Edit CSS</a><br>

<font size=1 face=verdana><b>Lan Signups :</b></font> <br>
&nbsp;&nbsp;<a href='adminnew.php?page=subscriptions'>Update Payment status</a><br>


<font size=1 face=verdana><b>Event :</b></font> <br>
&nbsp;&nbsp;<a href='adminnew.php?page=addevent'>Add Event</a> |
&nbsp;&nbsp;<a href='adminnew.php?page=editevent'>Edit Latest Event</a> |
&nbsp;&nbsp;<a href='adminnew.php?page=showevents'>Show all events</a><br>

<font size=1 face=verdana><b>Mailing :</b></font> <br>
&nbsp;&nbsp;<a href='adminnew.php?page=mail'>Mail Someone</a> |
&nbsp;&nbsp;<a href='adminnew.php?page=mailinglist'>view mailing list</a> |
&nbsp;&nbsp;<a href='adminnew.php?page=maillist'>Mail Users on mailing list</a> <br>
&nbsp;&nbsp;<a href='adminnew.php?page=maillandudes'>Mail the fuck faces who have not signed up for the lan</a> <br>
&nbsp;&nbsp;<a href='adminnew.php?page=maileverybody'>Mail everybody on site who have not paid</a> <br>
<br><hr>


";


/* @phpstan-ignore-next-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ $refresh = "<script language=javascript>
setTimeout(\"document.location.href='$HTTP_REFERER&done';\", 1500);
</script>";

print $adminmenu;








/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ switch($page){



case "addpage":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if($pageadd){

/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ $sql = $stream->do_query("INSERT INTO site_english VALUES ('','$pagename','','','','')","one");

print "Page added!";

}

else{

print "<form action='adminnew.php?page=addpage&pageadd=true' method='post'>";
print "<input class='tbox'  type='text' name='pagename'><br>";
print "<input class='tbox'  type=submit value='add page'>";
print "</form>";

}

break;





case "addevent":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if($eventadd){

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ $message = eregi_replace("\"","\\\"",$message);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ $message = eregi_replace("'","\'",$message);

/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ $sql = $stream->do_query("INSERT INTO site_events VALUES ('','$name','$date','$cookieuser','$message','$location','$url','$month','0','0','$iptrack')","one");

print "event added!";

}

else{

print "<form action='adminnew.php?page=addevent&eventadd=true' method='post'>";
print "<table cellpadding=1 border=0>";
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ print "<tr><td valign=top>Poster</td><td valign=top>$cookieuser</td></tr>";
print "<tr><td valign=top>(subject, Title, Event Name)</td><td valign=top><input class='tbox'  type='text' name='name'></td></tr>";
print "<tr><td valign=top>Dates</td><td valign=top><input class='tbox'  type='text' name='date'></td></tr>";
print "<tr><td valign=top>Month</td><td valign=top><input class='tbox'  type='text' name='month'></td></tr>";
print "<tr><td valign=top>Location</td><td valign=top><input class='tbox'  type='text' name='location'></td></tr>";
print "<tr><td valign=top>Message Body</td><td valign=top><textarea class=text cols=60 rows=15 name=message></textarea></td></tr>";
print "<tr><td valign=top>Url (more info)</td><td valign=top><input class='tbox'  type='text' name='url'></td></tr>";
print "<tr><td valign=top>Done!</td><td valign=top><input class='tbox'  type=submit value='add page'></td></tr>";
print "</table>";
print "</form>";


}

break;



case "editevent":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if($eventedit){

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ $message = eregi_replace("\"","\\\"",$message);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ $message = eregi_replace("'","\'",$message);

/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ /** @psalm-suppress UnusedVariable, UndefinedGlobalVariable */ $sql = $stream->do_query("update site_events set event='$name', dates='$date', poster='$cookieuser', msg='$message', location='$location', url='$url', month='$month' where id=$idman","one");

print "event edited!";

}

else{
/* @phpstan-ignore-line */ $re = count($stream->do_query("select * from site_events", "array"));
/* @phpstan-ignore-line */ $resultt = $stream->do_query("select * from site_events where id='$re'", "array");
$num1 = count($resultt);

for($i=0;$i<$num1;$i++){

$tmp = $resultt[$i];
$id = $tmp[0];
$name = $tmp[1];
$date = $tmp[2];
$user = $tmp[3];
$message = $tmp[4];
$location = $tmp[5];
$url = $tmp[6];
$month = $tmp[7];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $ip = $tmp[10];



print "<form action='adminnew.php?page=editevent&eventedit=true&idman=$id' method='post'>";
print "<table cellpadding=1 border=0>";
print "<tr><td valign=top>Poster</td><td valign=top>$user</td></tr>";
print "<tr><td valign=top>(subject, Title, Event Name)</td><td valign=top><input class='tbox'  type='text' value='$name' name='name'></td></tr>";
print "<tr><td valign=top>Dates</td><td valign=top><input class='tbox'  type='text' value='$date' name='date'></td></tr>";
print "<tr><td valign=top>Month</td><td valign=top><input class='tbox'  type='text' value='$month' name='month'></td></tr>";
print "<tr><td valign=top>Location</td><td valign=top><input class='tbox'  type='text' value='$location' name='location'></td></tr>";
print "<tr><td valign=top>Message Body</td><td valign=top><textarea class=text cols=60 rows=15 name=message>$message</textarea></td></tr>";
print "<tr><td valign=top>Url (more info)</td><td valign=top><input class='tbox'  type='text' value='$url' name='url'></td></tr>";
print "<tr><td valign=top>Done!</td><td valign=top><input class='tbox'  type=submit value='edit page'></td></tr>";
print "</table>";
print "</form>";

}

}

break;





case "edit":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $resultt = $stream->do_query("select * from site_english where id='$what'", "array");
$num1 = count($resultt);

for($i=0;$i<$num1;$i++){

$tmp = $resultt[$i];
$id = $tmp[0];
$page = $tmp[1];
$pagecontents = $tmp[2];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $pagetype = $tmp[3];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $pagelastedited = $tmp[4];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $pagecreated = $tmp[5];

print "

<form action=\"adminnew.php?page=editit\" method=\"POST\">

<table width=400 cellpadding=5 border=1><tr>

<td width=100%><p>Name : $page</p>

</td></tr><tr>\n

<td width=100%>The contents :<br> 

<textarea class=text cols=\"100\" rows=\"45\" name=\"message\">$pagecontents</textarea>

</td>\n

</tr><tr><td>

<table><tr><td>

<input class='tbox'  type=\"hidden\" name=\"id\" value=\"$id\">

<input class='tbox'  type=\"submit\" value=\"Edit!\"></form></td><td>

<form action=\"adminnew.php?page=delete\" method=\"POST\">

<input class='tbox'  type=\"hidden\" name=\"id\" value=\"$id\">

<input class='tbox'  type=\"hidden\" name=\"drop\" value=\"dropit\">

<input class='tbox'  type=\"submit\" value=\"Delete\"></form>

</td></tr></table>

</td></tr></table>";

}

break;





case "updatesubs":

print "Mint!<br>";

print "doing <br>";

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $counter = count($subs);

for ($e=0;$e<$counter;$e++){

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $crap = explode("#",$subs[$e]);

$id = $crap[0];
$num = $crap[1];

print "Updated id $id to $num<br>"; 

/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $update = $stream->do_query("update site_lansignup set payedmonies='$num' where id='$id'","one");

}


break;






case "subscriptions":



/* @phpstan-ignore-line */ $result = $stream->do_query("select * from site_lansignup order by name,payedmonies asc", "array");
$num1 = count($result);

print "<form action='adminnew.php?page=updatesubs' method=post>";
print "<center><table cellpadding=2 cellspacing=0 border=0 width=90%><tr>";
print "<tr><td><font><b>Name </td><td><font><b>Location</td><td><font><b>Email</td><td align=right><font><b>Payed up</td></tr>"; // codespell:ignore payed

for($i=0;$i<$num1;$i++){
$checked1 = "";
$tmp = $result[$i];
$id = $tmp[0];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $username = $tmp[1];
$name = $tmp[2];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $age = $tmp[4];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $dob = $tmp[5];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $address = $tmp[6];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $tel = $tmp[7];
$country = $tmp[8];
$county = $tmp[9];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $other = $tmp[10];
$email = $tmp[11];
$payed = $tmp[12]; // codespell:ignore payed
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $games = $tmp[13];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $reg = $tmp[14];
if($payed==1){ // codespell:ignore payed
$checked1 = "selected";
}


print "<tr><td><font>$name</td><td><font>$county,$country</td><td><font>$email</td>
<td align=right>
<select name='subs[]'>
<option value='$id#0'>No
<option value='$id#1' $checked1 >Yes
</select></td></tr>";
}

print "<tr><td colspan=4><br></td></tr>";
print "<tr><td colspan=2><font><b>Update </td><td><font><b><input type=submit class=tbox value='Update payment status'></td></tr>";
print "</table>";
print "<input type=hidden name=update value=true>";
print "</form>";


break;









case "editit":

$refresh = "<script language=javascript>

setTimeout(\"document.location.href='adminnew.php?';\", 1500);

</script>";

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ /** @psalm-suppress UndefinedFunction, PossiblyUndefinedVariable */ $message = eregi_replace("\"","\\\"",$message);
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ $message = eregi_replace("'","\'",$message);


/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $resultt = $stream->do_query("UPDATE site_english set pagecontents = '$message' where id = '$id'", "one");


if($resultt!="bad"){

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ print "<br><br><br><center>successfull $ok $refresh"; // codespell:ignore successfull

}

else {

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ print "<br><br><br><center>unsuccessfull $notok $refresh"; // codespell:ignore unsuccessfull

}

break;









case "mail":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$m) {

$m=1;

}

if($m==1){

/** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ echo("

<br>

<br><FORM method='POST' ACTION='adminnew.php?page=mail&m=2'>

<table cellpadding=5 cellspacing=0 border=0><tr>

<td valign=top><p>Subject:</td><td valign=top>

<input class='tbox'  type='text' name='subject' value='Great News from Megalan.net' size='40'></td>

</tr><tr>

<td valign=top><p>Your Name:</td><td valign=top>

<input class='tbox' type='text' name='name' value='" /* @phpstan-ignore-line */ . $cookieuser . "' size='20'></td>

</tr><tr>

<td valign=top><p>Your address:</td><td valign=top>

<input class='tbox'  type='text' name='resource' value='" /* @phpstan-ignore-line */ . $cookieuser . "@megalan.net' size='20'></td>

</tr><tr>

<td valign=top><p>Receiver:</td><td valign=top>

<input class='tbox'  type='text' name='email' value='some@one.com' size='20'></td>

</tr><tr>

<td valign=top><p>Your Message:</td><td valign=top>

<textarea class=text rows='25' cols='80' wrap='off' name='message'></textarea>

</td></tr><tr><td valign=top colspan=2>

<input class='tbox'  type='submit' value='Send'></form>

</td></tr></table>");

} 

if($m==2){



    /* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $subject = "$subject";

	$headers  = "MIME-Version: 1.0\r\n";

$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

   /* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $headers .= "From: $resource";

    /* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $address = "$email";

	/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $msg = "<font face=verdana,arial size=2 color=#ffeead><br>Dear $email <br><br> $message <br><br> - $name </font>";



    /* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if((!$name) || (!$email) || (!$message)) {

        die("<br><br><br><center>please go back and enter all feilds"); // codespell:ignore feilds

    } else {

        mail($address, $subject, $msg, $headers);

        echo "<br><br><br><center>Email sent!";

    }

}

break;
















case "maillist":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$m) {

$m=1;

}

if($m==1){

/** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ echo("

<br>

<br><FORM method='POST' ACTION='adminnew.php?page=maillist&m=2'>

<table cellpadding=5 cellspacing=0 border=0>


<td valign=top><p>Subject:</td><td valign=top>

<input class='tbox'  type='text' name='subject' value='Updates from Megalan.net' size='40'></td>

</tr><tr>

<td valign=top><p>Your Name:</td><td valign=top>

<input class='tbox'  type='text' name='name' value='" /* @phpstan-ignore-line */ . $cookieuser . "' size='20'></td>

</tr><tr>

<td valign=top><p>Your address:</td><td valign=top>

<input class='tbox'  type='text' name='resource' value='" /* @phpstan-ignore-line */ . $cookieuser . "@megalan.net' size='20'></td>

</tr><tr>

<td valign=top><p>Receiver:</td><td valign=top>

Mailing list where activated = 1</td>

</tr><tr>

<td valign=top><p>Your Message:</td><td valign=top>

<textarea class=text rows='15' cols='80' wrap='off' name='message'></textarea>

</td></tr><tr><td valign=top colspan=2>

<input class='tbox'  type='submit' value='Send'></form>

</td></tr></table>");

} 

if($m==2){


/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if((!$name) || (!$resource) || (!$message)) {
/* @phpstan-ignore-line */ die_nice("<br><br><br><center>please go back and enter all feilds"); // codespell:ignore feilds
} 
else {

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ $mails = mysql_query("SELECT * FROM site_users where mailinglist='1'");

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ while($row = mysql_fetch_array($mails)){

/* @phpstan-ignore-line */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ $subject = "$subject";
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: $resource";
$address = "$row[email]";
$msg = "<font face=verdana,arial size=2 color=#ffeead><br>Hello $row[email], <br><br> $message <br><br> - $name </font>";
mail($address, $subject, $msg, $headers);
echo"<br>Email sent! ($row[email])";
}
}
}

break;










case "maillandudes":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$m) {

$m=1;

}

if($m==1){

/** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ echo("

<br>

<br><FORM method='POST' ACTION='adminnew.php?page=maillandudes&m=2'>

<table cellpadding=5 cellspacing=0 border=0>


<td valign=top><p>Subject:</td><td valign=top>

<input class='tbox'  type='text' name='subject' value='Updates from Megalan.net' size='40'></td>

</tr><tr>

<td valign=top><p>Your Name:</td><td valign=top>

<input class='tbox'  type='text' name='name' value='" /* @phpstan-ignore-line */ . $cookieuser . "' size='20'></td>

</tr><tr>

<td valign=top><p>Your address:</td><td valign=top>

<input class='tbox'  type='text' name='resource' value='" /* @phpstan-ignore-line */ . $cookieuser . "@megalan.net' size='20'></td>

</tr><tr>

<td valign=top><p>Receiver:</td><td valign=top>

Mailing list where activated = 1</td>

</tr><tr>

<td valign=top><p>Your Message:</td><td valign=top>

<textarea class=text rows='15' cols='80' wrap='off' name='message'></textarea>

</td></tr><tr><td valign=top colspan=2>

<input class='tbox'  type='submit' value='Send'></form>

</td></tr></table>");

} 

if($m==2){


/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if((!$name) || (!$resource) || (!$message)) {
/* @phpstan-ignore-line */ die_nice("<br><br><br><center>please go back and enter all feilds"); // codespell:ignore feilds
} 
else {

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ $mails = mysql_query("SELECT * FROM site_users");

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ while($row = mysql_fetch_array($mails)){

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedConstant */ /** @psalm-suppress UndefinedConstant */ $sql = $row[email];
/* @phpstan-ignore-line */ $sql2 = $stream->do_query("select email from site_lansignup where username='$row[username]'","one");

if($sql!=$sql2){
/* @phpstan-ignore-line */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ $subject = "$subject";
/* @phpstan-ignore-line */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ $headers .= "From: $resource";
$address = "$row[email]";

$msg = "Hello $row[username] ($row[email]),\n\n $message \n\n - $name";
mail($address, $subject, $msg, $headers);
echo"<br>Email sent! ($row[email])";
}
}
}
}

break;









case "maileverybody":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$m) {

$m=1;

}

if($m==1){

/** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ echo("

<br>

<br><FORM method='POST' ACTION='adminnew.php?page=maileverybody&m=2'>

<table cellpadding=5 cellspacing=0 border=0>


<td valign=top><p>Subject:</td><td valign=top>

<input class='tbox'  type='text' name='subject' value='Updates from Megalan.net' size='40'></td>

</tr><tr>

<td valign=top><p>Your Name:</td><td valign=top>

<input class='tbox'  type='text' name='name' value='" /* @phpstan-ignore-line */ . $cookieuser . "' size='20'></td>

</tr><tr>

<td valign=top><p>Your address:</td><td valign=top>

<input class='tbox'  type='text' name='resource' value='" /* @phpstan-ignore-line */ . $cookieuser . "@megalan.net' size='20'></td>

</tr><tr>

<td valign=top><p>Receiver:</td><td valign=top>

everybody who hasn't paid (show me the fucking money)</td>

</tr><tr>

<td valign=top><p>Your Message:</td><td valign=top>

<textarea class=text rows='15' cols='80' wrap='off' name='message'></textarea>

</td></tr><tr><td valign=top colspan=2>

<input class='tbox'  type='submit' value='Send'></form>

</td></tr></table>");

} 

if($m==2){


/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if((!$name) || (!$resource) || (!$message)) {
/* @phpstan-ignore-line */ die_nice("<br><br><br><center>please go back and enter all feilds"); // codespell:ignore feilds
} 
else {

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ $mails = mysql_query("SELECT * FROM site_users");

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedFunction */ /** @psalm-suppress UndefinedFunction */ while($row = mysql_fetch_array($mails)){

/* @phpstan-ignore-line */ /** @psalm-suppress UnusedVariable, UndefinedConstant */ /** @psalm-suppress UnusedVariable, UndefinedConstant */ $sql = $row[email];
/* @phpstan-ignore-line */ $sql2 = $stream->do_query("select payedmonies from site_lansignup where username='$row[username]'","one");

if($sql2==1){
print "$row[username] $row[email] not mailed";
}
else {
/* @phpstan-ignore-line */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ $subject = "$subject";
/* @phpstan-ignore-line */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ $headers .= "From: $resource";
$address = "$row[email]";

$msg = "Hello $row[username] ($row[email]),\n\n $message \n\n - $name";
mail($address, $subject, $msg, $headers);
echo"<br>Email sent! ($row[email])";
}
}
}
}

break;











case "mailinglist":

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$deleteuser){

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ if(!$numemail){

/* @phpstan-ignore-line */ $resultt = $stream->do_query("SELECT * FROM site_users", "array");
$num1 = count($resultt);


echo("<center><br><br>

<table border=1 cellpadding=5><tr><td><center><b>Email :</b> </td><td><center><b>On Mailing list? :</b></td></tr>");

for($i=0;$i<$num1;$i++){

$tmp = $resultt[$i];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $id = $tmp[0];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $name = $tmp[1];
$email = $tmp[11];
$act = $tmp[17];

print "<tr><td><font face=arial size=1>$email </td><td><font face=arial size=1>$act 

</td></tr>";

}

print "</table><br><br>";

}

}



break;























default:


print "<br>";


print "<table cellpadding=3 cellspacing=0><tr>";



$p=0;

echo "<td>"; 

/* @phpstan-ignore-line */ $resultt = $stream->do_query("select * from site_english", "array");
$num1 = count($resultt);

for($i=0;$i<$num1;$i++){
$tmp = $resultt[$i];
$id = $tmp[0];
$page = $tmp[1];


if($id=="19"){
continue;
}
if($id=="20"){
continue;
}
if($id=="21"){
continue;
}
if($id=="30"){
continue;
}
if($id=="23"){
continue;
}

 if ($p%2<1){ 

echo "<tr>"; 

} 

print "<td width=100><a href='adminnew.php?page=edit&what=$id'>$page</a></td>";



if ($p%2>0){ 

echo "</tr>"; 

} 

$p++;

}









print "</table>";


break;





}




}

else {

/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ login("adminnew.php",$fail);

}
		

	
		

if(!$printable){
/* @phpstan-ignore-line */ footer();
}
?>
<?php // jscpd:ignore-end ?>
