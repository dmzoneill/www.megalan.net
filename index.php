<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Next Lan Event","MegaLan.net Next Lan Event");


include("events.php");
include("countdown.php");


intersection("Latest Submissions");

include("news-shout.php");

include("recent.php");


intersection("Megalan.net Member Options");

if(validatecookie($msg)==1){
include("pmsinc.php");
}
else {
login("index.php",$fail);
}
		
		
		
		

footer();

?>