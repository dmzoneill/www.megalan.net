<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Member Signup","MegaLan.net Member Signup");
	
				
		
		
				
$fucker = $stream->do_query("select user_id from phpbb_users","array");

for($r=0;$r<count($fucker);$r++){


$tmp = $fucker[$r];
$id = $tmp[0];
print $id."<br>";
}

$whatwewant = $id +1;
				
print "<br><br>$whatwewant";
			
				
				
				
		

footer();

?>