<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");



sheader("MegaLan.net Shout Box message poster","MegaLan.net Shout Box message poster");
	
if(validatecookie($msg)==1){


print "<table cellpadding=3 cellspacing=0 borber=0><tr><td>";

$sql2 = $stream->do_query("select * from site_shoutbox","array");
$numb = count($sql2);
$sql = $stream->do_query("select username from site_shoutbox where id='$numb'","one");
if($cookieuser==$sql){
die_nice("You've already posted today");
}












if($message=="add"){

$badwords = array("fuck","shit","dick","arse","pussy","cunt","asshole","ass","jackass","bitch","whore","faggot","langer","wanker","wank","cock","knob","clit","fanny","anal","bastard","fuckface","nigger","nigga","The","pube","short and curly","blowjob","homo");
$num = count($badwords);

for($i=0;$i<$num;$i++){
if(stristr($Comments,"$badwords[$i]")){
$hash = strlen("$badwords[$i]");
for($p=0;$p<$hash;$p++){
$replace = "$replace"."*";
}
}

$Comments = ereg_replace("$badwords[$i]", "$replace", $Comments);
$replace = " &nbsp;";
}
if(strlen($title)>5){
$dateg = date("F j, Y, g:i a");
$title = HTMLSpecialChars($title); 
$Comments = HTMLSpecialChars($Comments); 
$Comments = eregi_replace("\"","\\\"",$Comments);
$Comments = eregi_replace("'","\'",$Comments);
$title = eregi_replace("\"","\\\"",$title);
$title = eregi_replace("'","\'",$title);
$sql = $stream->do_query("insert into site_shoutbox values ('','$cookieuser','$Comments','$dateg','$iptrack','$title')","one");
if($sql!="bad"){
print "<font>Thanks for your Shout!";
}
}
else{
print "<font>Specifiy a title greater then 5 characters";
}
}


else {

?>

<script LANGUAGE="JavaScript">
<!-- Begin

function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
countfield.value = maxlimit - field.value.length;
}


if (navigator.appName == 'Netscape') br = "\n";
else br = "<br>";
function validate()
{
error = "";
cmd = "";

changeCase(document.addform.Title);



if (document.addform.elements["Download URL"].value == "http://" || document.addform.elements["Download URL"].value == document.addform.URL.value) document.addform.elements["Download URL"].value="";

if (!error) {
if (document.addform.elements["Comments"].value != "")
document.addform.elements["Description"].value = "- - - - C O M M E N T S - - - - \n" + document.addform.elements["Comments"].value + "\n- - - - C O M M E N T S - - - - \n\n" + document.addform.elements["Description"].value;
return true;
}


}
// End -->
</script>


<table cellpadding=3 cellspacing=0 border=0 width=100%>


<form name=addform action="shoutbox.php?message=add" method="POST">
<tr><td><font>Title :</td></td><td><input class='tbox' type=text name=title size=22 MAXLENGTH=20></td></tr>

<tr><td><font>Message </td></td><td><textarea class='text' wrap="virtual" name="Comments" value="" rows="7" cols="50" onKeyDown="textCounter(this.form.Comments,this.form.commentsleft,255);" onKeyUp="textCounter(this.form.Comments,this.form.commentsleft,255);"></textarea>
<input class='tbox' readonly type=text name=commentsleft size=3 maxlength=3 value="255" tabindex=255> </td></tr>

<?php


print "<tr><td><font><br>Done : </td></td><td><input class='tbox' type=submit value='Add comment'></td></tr>";
print "</form></table>";

}

















print "</td></tr></table>";




}


else {
login("member-cp.php",$fail);
}

		

footer();

?>