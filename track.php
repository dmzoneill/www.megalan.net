<?php
// track.php

$cookie_domain = '.megalan.net'; 
$goodcookie = $HTTP_COOKIE_VARS['goodcookie'];
if ($step=="auth"){
$usernamedb = $stream->do_query("select * from site_users where username='$u'","row");
$userpass = "$usernamedb[1]:$usernamedb[3]";
$p = md5($p);
if ($usernamedb[23]>=1){
if ($userpass=="$usernamedb[1]:$p"){ 
      $cookiecontents = "yes|$usernamedb[1]|$p";
      setcookie("goodcookie", $cookiecontents, time()+3600, "/", $cookie_domain);
	  $timer = time()+3600;	  
	  $update = $stream->do_query("update site_users set loggedin='1', loggedtime='$timer' where username='$u'","one");	  
      $goodcookie = "yes";
$cookieuser = $u;
$cookiepass = $p;
      }
	  else {
	  $fail = 1;
	  }
	  
}
else {
$cookieuser = "Guest";
$cookiepass = "nope";
$fail = 1;
}
}

else{

$timep = time()-3600;
$update = $stream->do_query("update site_users set loggedin='0' where loggedtime<$timep","one");

if(stristr($HTTP_COOKIE_VARS['goodcookie'], 'yes')) {
if($HTTP_COOKIE_VARS['goodcookie']){
$cookie = explode("|",$goodcookie);
 $timer = time()+180;
$cookieuser = $cookie[1];
$cookiepass = $cookie[2];
$update = $stream->do_query("update site_users set loggedin='1', loggedtime='$timer' where username='$cookieuser'","one");	
}
}
else {
$cookieuser = "Guest";
$cookiepass = "nope";
}
}

$cookiejava = "<script language=javascript>\n
<!----\n
var cookieuser = \"$cookieuser\";
var cookiepass = \"$cookiepass\";
//---->\n
</script>";

$ggg = md5($cookieuser);

$msg = $HTTP_COOKIE_VARS['goodcookie'];
$iptrack = getenv('REMOTE_ADDR');


?>