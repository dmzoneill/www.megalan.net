<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Member Login","MegaLan.net Member Login");

				
if(!$url){
login("index.php",$fail);
}

if($url){
?>

<script language=javascript>
setTimeout("document.location.href='<?php echo $url; ?>?loggedin<?php if($fail) print "&fail=1"; ?>'", 0001);
</script>

<?php
print "<font>Redirecting .....";
}

		

footer();

?>