<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Staff","MegaLan.net Staff");
	
			
switch($page){				
				
default:
$page = $stream->do_query("select pagecontents from site_english where pagename='staff'","one");				
print $page;

break;


case "contact":



if($message){

if($megadude){
$query = $stream->do_query("select username from site_users where rank>2","array");
for($r=0;$r<count($query);$r++){
$tmp = $query[$r];
$username = $tmp[0];
if($megadude==$username){
}
}
}

else {
print "<font>The specified username is not staff or a ranking member";
}

}

break;

}



		

footer();

?>