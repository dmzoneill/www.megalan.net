<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");


sheader("MegaLan.net Help Section","MegaLan.net Help Section");

print "<br>";

require ("/usr/webdata/web70/web/faq/conf.inc.php");
require ("/usr/webdata/web70/web/faq/odfaq.inc.php");

InsertAll();


print "<br>";

footer();

?>