<?php


$poll = $stream->do_query("select * from phpbb_topics order by topic_id desc", "array");

for($x=0; $x<count($poll); $x++) {

$tmp = $poll[$x];
$id = $tmp[0];
$forum = $tmp[1];
$name = $tmp[2];
$vote = $tmp[8];

if(($forum=="11") && ($vote=="1")){
print "<font>".$name."<br>";
print "<p align=right><a class=body href='http://www.megalan.net/phpbb/viewtopic.php?t=$id'>Have your say!</a></p>";
break;
}

}



?>