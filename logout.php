<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Member Logout","MegaLan.net Member Logout");

		


if($step=="logout"){
$cookie_domain = '.megalan.net'; 
$cookiecontents = "no";
$timer = time()-3600;
$cookie = explode("|",$goodcookie);
$cookieuser = $cookie[1];
setcookie("goodcookie", $cookiecontents, time()-3600, "/", $cookie_domain);
$update = $stream->do_query("update site_users set loggedin='0', loggedtime='$timer' where username='$cookieuser'","one");	 
}

print "<font>You have successfully logged out!";

$idf = md5(time());
print "<script language=javascript>\n
setTimeout(\"document.location.href='index.php?out=$idf'\",1000);\n
</script>";




footer();

?>