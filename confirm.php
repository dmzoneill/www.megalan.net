<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Member Confirmation","Megalan.net Member Confirmation");

print "<font>";


switch ($page){

case "newmember":

if($confirm){
$confirm = eregi_replace("\"","\\\"",$confirm);
$confirm = eregi_replace("'","\'",$confirm);
$query = $stream->do_query("select rank,username from site_users where password='$confirm'","row");
if($query[0]==0){
$update = $stream->do_query("update site_users set rank=1 where password='$confirm'","one");
if($update!="bad"){
print "Well done $query[1], you've successfully activated your account!<br><br>";
print "<font class=mainhead>You can now sign up for the next MegaLan Event</font><br> <a href=event-signup.php>Sign Up Now</a>";
}
else {
print "There was a problem while activating your account, please make sure that there are no \' and \" in the location bar. <br> Also try copying and pasting the link into the location bar if your having problems else contact dave@megalan.nets";
}
}
}
else {
print "Arguments not passed";
}

break;



case "resend":


if(($userage) && ($emailage)){

$result = $stream->do_query("select password,rank,email,username from site_users where username='$userage'","row");

if($result[2]==$emailage){
if($result[1]>0){
print "That account is already activated";
}
else {

$topic = "Registration Confirmation @ Megalan.net";
$resource = "services@megalan.net";
$message = "$result[3] an email has been requested concerning your Megalan.net registration<br><br>";
$message .= "To activate your account please click the following link or copy it into the location bar of your browser<br> ";
$message .= "<a href='http://www.megalan.net/confirm.php?page=newmember&confirm=$result[0]'>http://www.megalan.net/confirm.php?page=newmember&confirm=$result[0]</a>";
$message .= "<br><br>If you have any problems with your registration please contact dave@megalan.net for troubleshooting<br><br>Dave.<br><br>";

webemail($topic,$result[2],$resource,$message);

print "An email has been sent again concerning your megalan.net Registration ($emailage)";

}
}
else {
print "Email does not belong to that account!";
}
}







else {

print "<table width=450 cellpadding=3 cellspacing=0 border=0>";
print "<form action=confirm.php?page=resend method=post>";

print "<tr><td width=200><font>Username </td><td> <input class=tbox type=text name=userage> </td></tr>";
print "<tr><td><font>Email Address </td><td> <input class=tbox type=text name=emailage> </td></tr>";
print "<tr><td><font>Request Activation Email </td><td> <input class=tbox type=submit> </td></tr>";

print "</form>";
print "</table>";

}



break;




default :


print "Welcome to megalan.net";


break;


}
		



footer();

?>