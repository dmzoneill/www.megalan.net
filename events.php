<?php

// this is an include

$events = count($stream->do_query("select * from site_events","array"));
$eventlist = $stream->do_query("select * from site_events where id='$events'","row");


print "<b><font class=mainhead>$eventlist[1]</font></b><br>
$eventlist[4] <br><table cellpadding=3 border=0 cellspacing=0 bgcolor='' width=100%><tr><td width=100%>
<a href='$eventlist[6]'> More info >>> </a><br><br>";

?>