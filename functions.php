<?php

//functions





function webemail($topic,$email,$resource,$message){
$subject = "$topic";
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: $resource";
$msg = "<table cellspacing=0 cellpadding=5 border=0 bgcolor=#ffffff><tr><td valign=top>$message</td></tr></table>";
if(mail($email, $subject, $msg, $headers)){
print "<br><font class=mainhead>An email has been sent to the following address concerning the information you requested.<br>In order to activate your account you must follow the instructions in this email!<br><br> Please check your mail! $email";
}
else {
print "<br><font class=mainhead> Failed to send email<br>Even though your account may have completed successfully you cannot activate use your account becasue you need to activate through your email account.<br>Please contact services@megalan.net for help!";
}
}




function smilies($messages){ 
$messages = eregi_replace(";-\)","<img src='http://www.megalan.net/phpbb/images/smiles/icon_wink.gif'>",$messages);
$messages = eregi_replace(";\)","<img src='http://www.megalan.net/phpbb/images/smiles/icon_wink.gif'>",$messages);
$messages = eregi_replace(":\|","<img src='http://www.megalan.net/phpbb/images/smiles/icon_neutral.gif'>",$messages);
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
return $messages;
}


function die_nice($msg){
global $stream;
$tend =  "</td><td width='10'></td></tr><tr><td></td><td></td><td></td></tr></table>";
$right = $stream->do_query("select pagecontents from site_english where pagename='t-right'","one");
$shit = include("footer.php");
die("<font>$msg $tend $right $shit");
}











function login($url,$fail){
global $stream;
global $cookieuser;
if($fail==1){
print "<center><br><table width='80%' border='0' cellspacing='0' cellpadding='1'><tr><td bgcolor='#222222'>
<center>
<table width='100%' border='0' cellspacing='3' cellpadding='0' bgcolor='#999999'><tr><td><a name=failure color=red>Failure</font></td>
<td><font>Note : Usernames & Passwords ase case sensitive<br>Make sure your browser is accepting cookies!
</td></tr></table></td></tr></table>";
}
print "
<form action='login.php?url=$url' method=post>
<table width='100%' border=0>
<tr><td> <font>
<b>Username</b> </td><td>
<input class='tbox' type=text name='u'>
</td></tr>
<tr><td>
<font>
<b>Password</b>
</td><td>
<input class='tbox' type=password name='p'>
<input type=hidden name=step value=auth>
</td>
</tr>
<tr><td></td><td>
<input class='tbox' type=submit value=login name=submit>
</td>
</tr>
<tr><td><font><b>Problems?</b>
</td><td><font>
<a href='help.php'> Help </a>
</td>
</tr>
</tr>
<tr><td><font><b>Options</b>
</td><td><font>
<a href='member-signup.php'>Signup</a> | <a href='confirm.php?page=resend'>Resend Activation email</a> | <a href='member-cp.php'>Edit Account</a> | <a href='players.php'>Member Listing</a> | <a href='lostpw.php'>Lost Password</a>";

print "
</td>
</tr>
</table>
</form>";


}











function youfuckup($name,$email,$pass,$len){
$back = "<br><a href='javascript:history.back(-1)'>Back to Signup page</a><br><br>";

if($pass=="bad"){
die_nice("<font>Your confirmed password does not match the password you provided<br>$back");
}
if($len=="bad"){
die_nice("<font>Your password must be at least 8 characters or numbers<br>$back");
}
if($name=="bad"){
die_nice("<font>The username you specified matches a user already in our database<br>$back");
}
if($email=="bad"){
die_nice("<font>The email address you specified is not a valid email address or <br>The email you specified matches a email already in our database<br>$back");
}
else {
return 0;
}
}













function sheader($msg,$title){
global $stream;
global $cookiejava;
global $auth;
global $cookieuser;
global $refresh;
print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n
<html>\n
<head>\n
<title>$title</title>\n";
$css = $stream->do_query("select pagecontents from site_english where pagename='t-css'","one");
print "<style>\n $css \n</style>\n";
print $cookiejava;
print "</head>\n";
$header = $stream->do_query("select pagecontents from site_english where pagename='t-header'","one");
print "$header";
include("getRandomImage.php");
$left = $stream->do_query("select pagecontents from site_english where pagename='t-left'","one");
echo($left);
print "<center>\n";
print "<TABLE borderColor=#999999 cellSpacing=0 cellPadding=0 height=100% width=600 border=1>
<TBODY>
<TR>
<TD width=4 height=22>&nbsp;</TD>
<TD background=img/wide_headb.jpg colSpan=3>
<center><font class=mainhead>$msg</font></center></TD>
<TD width=4>&nbsp;</TD></TR>
<TR>
<TD width=4>&nbsp;</TD>
<TD vAlign=top borderColor=#000000 align=left bgColor=#cccccc colSpan=3>";
}









function footer (){
global $stream;

intersection("Users Online");

print "<table cellpadding=3 cellspacing=0 border=0><tr><td><font>";

$query1 = $stream->do_query("select id,username from site_users where loggedin=1 order by username desc","array");

$shit = count($query1);
if($shit>0){
print "Members Online :";
}
else {
print "No Members Online!";
}

for ($g=0;$g<count($query1);$g++){
$tmp = $query1[$g];
$id = $tmp[0];
$usr = $tmp[1];

print "<b> <a href='players.php?code=member&id=$id'>$usr</a></b>";

if($g!=$shit-1){
print ",";
}
}


print "<br>";

print "</td></tr></table></TD><TD width=4></TD></TR><TR><TD></TD><TD>";				
print "</TD><TD></TD></TR></TBODY></TABLE></CENTER>";
$right = $stream->do_query("select pagecontents from site_english where pagename='t-right'","one");
echo($right);
include("lastpoll.php");
$footer = $stream->do_query("select pagecontents from site_english where pagename='t-footer'","one");
echo($footer);
}










function validatecookie($msg){
if (strlen($msg)<2) return 0;
global $stream;
$goodcookie = $msg;
$cookie = explode("|",$goodcookie);
$userauth = $cookie[1];
$passauth = $cookie[2];
$rank = $stream->do_query("select rank from site_users where username='$userauth'","one");
$authuser = $stream->do_query("select password from site_users where username='$userauth'","one");
if($passauth==$authuser && $passauth!="" && $rank>0){
return 1;
} else {
return 0;
}
}









function intersection($msg){
print "</td></tr></table><br>";
print "

      <TABLE borderColor=#999999 cellSpacing=0 cellPadding=0 width=600 
            border=1>
                    <TBODY>
              <TR>
                        <TD width=4 height=22></TD>
                <TD width=586 background=img/wide_headb.jpg>
                 <center><font class=mainhead>$msg</font></center></TD>
                        <TD width=4></TD>
                      </TR>
              <TR>
                        <TD width=4></TD>
                <TD vAlign=top borderColor=#000000 align=left width=580 
                bgColor=#cccccc>";
}







?>