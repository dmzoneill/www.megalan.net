<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Lost Password ","MegaLan.net Lost Password ");

if(validatecookie($msg)==0){

if($unightyfhskor){









$update = $stream->do_query("select email from site_users where username='$usern'","one");


if($update==$mailn){
$better_token = uniqid(1);

$better_token1 = md5($better_token);

$updatee = $stream->do_query("update site_users set password='$better_token1' where email='$mailn'","one");

if($updatee!="bad"){
$topic = "Password Lost @ Megalan.net";
$resource = "services@megalan.net";
$message = "Thank you for requesting a new password from Megalan.net!<br><br>";
$message .= "For future reference your account details are as follows<br>Username = $usern<br>And your new password is <br>Password = $better_token <br><br>";
$email = $mailn;
webemail($topic,$email,$resource,$message);
}
else {
print "<font>We were unable to update your password, please go back and try again!";
}

}

else {
print "<font>Account invalid or unexpected error!";
}










}
else {
print "<table cellpadding=5 cellspacing=0 border=0 width=400 bgcolor=''>";
print "<form action=lostpw.php?unightyfhskor=true method=post>";
print "<tr><td><font>Username : </td><td> <input class=tbox type=text name=usern></td></tr>";
print "<tr><td><font>Email Address : </td><td> <input class=tbox type=text name=mailn></td></tr>";
print "<tr><td><font>Give me a new password : </td><td> <input class=tbox type=submit value='I value my account!'></td></tr>";
print "</form>";
print "</table>";
}










}
else {
print "Your logged in, how would you have forgotten?";
}

		

footer();

?>