<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("MegaLan.net Signup","MegaLan.net Signup");
			
				
				

switch($clan){



default:

print "
<body onload='javascript:document.sign.conf.disabled=true'>
<form name=sign action='newclans.php?clan=confirm' method='post'>

<table cellpadding=5 cellspacing=5 border=0 width=500>

<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top>
<font face=verdana size=-1>Proposed Clan name : </td><td>
<input type=text name=name></td>
</tr>

<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top><font face=verdana size=-1>Captain Unique id: <br></td><td>
<input type=text name=captain><br><font face=verdana size=-2>Note - > your uniqueid can be gotten from your member account</font></td>
</tr>

<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top><font face=verdana size=-1>Vice - Captain Unique id : </td><td>
<input type=text name=vicecaptain><br><font face=verdana size=-2>Note - > Note get your vice captain to send you his unique id</font></td>
</tr>

<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top><font face=verdana size=-1>Clan Homepage: </td><td>
<input type=text name=homepage><br><font face=verdana size=-2>Note - > You cannot register a clan unless you got a official clan website</font></td>
</tr>

<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top><font face=verdana size=-1>Clan Game Server: </td><td>
<input type=text name=server><br><font face=verdana size=-2>Note - > Ip or hostanme is good here ie. 64.221.34.14:27016</font></td>
</tr>

<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top><font face=verdana size=-1>Game Type: </td><td>";

$clantypes = $stream->do_query("select * from site_games", "array");

for($x=1; $x<count($clantypes)+1; $x++) {
$tmp = $clantypes[$x];
$gamet = $tmp[1];
print "<input type=checkbox name='gametype$x' value='$gamet'><font face=verdana size=-2>$gamet</font><br>\n";
}

print "
<br><font face=verdana size=-2>Note - > If you wish to register for more than one type then make multiple accounts</font>
</td>
</tr>

<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top><font face=verdana size=-1>Looking for members: </td><td>
<input type=checkbox name=members><br><font face=verdana size=-2>Note - > If you wish your clan to be advertised as so!</font></td>
</tr>

<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top><font face=verdana size=-1>Clan Notes: </td><td>
<textarea cols=30 rows=4 name=notes>Note - > Information about your clan</textarea></td>
</tr>


<tr bgcolor='#EEEEEE' onMouseOver=\"this.style.background='#CCCCCC'\" onMouseOut=\"this.style.background='#EEEEEE'\" >
<td width=200 valign=top><font face=verdana size=-1>Finished: </td><td>
<script language=javascript>
function bitch(){
document.sign.conf.disabled=false
alert(\"Make sure the information inserted is correct!\");
}
</script>
<input onClick=\"bitch()\" type=checkbox><font face=verdana size=-2>Check this, if your happy with the information provided!</font>
</td>
</tr>

<tr bgcolor='#ffffff'>
<td width=200 valign=top><font face=verdana size=-1>Done: </td><td>
<input type=submit value='Sign clan up' name='conf'>
<a href='newclans.php?clan=terms' target='_blank'><br><br><font face=verdana size=1>Terms and conditions</a>
</tr>
</table>
</form>

";


break;



case confirm:

if($members){
$members = 1;
}


$clanname = $stream->do_query("select clan from clans where clan='$name'","one");

$today = date("D M j G:i:s T Y");

print "<h3>Clan registration in process!</h3><br>FYI = ><br>";

$clantypes = $stream->do_query("select * from site_games","array");


for($x=1; $x<count($clantypes)+1; $x++) {
$tmp = $clantypes[$x];
$gamet = $tmp[1];

for($i=1; $i<count($clantypes)+1; $i++) {
$tmp = $clantypes[$i];
$gamet = $tmp[1];
$gamer = ${"gametype".$x};

if($gamer==$gamet){
$games = $stream->do_query("select gametype from site_games where id='$x'", "one");
$query = $stream->do_query("INSERT INTO clans VALUES ('','$name', '', '$captain', '$vicecaptain', '$today', '$homepage', '$server', '', '$games', '$members', '0', '0')","one");
print "<br>Clan $name ( $games ) was successfully registered!<br>";
}
}
}



break;




case terms:

print "<h3>Terms and conditions</h3><br>FYI = ><br>";


break;


}



		

footer();

?>