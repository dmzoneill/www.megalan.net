<?php






function redoform($msg,$loginuser,$realname,$pass1,$pass2,$age,$dob,$address,$telephone,$country,$county,$other,$yahoo,$msn,$irc,$icq,$aim,$mailinglist,$loggedin){
global $stream;    
print "<br><center><table width=95% cellpadding=0  border=0 bgcolor='000000'><tr>
<td width=100%>
<table width=100% cellpadding=2 cellspacing=1 bgcolor='efefef' border=0><tr>
<td width=100%>
<font class=mainhead>
$msg</td></tr></table></td></tr></table>
<br>";



print "
<form name='adduser' action='new-signup.php?signup=adduser' method='post'>
<table cellpadding=2 cellspacing=0 border=0 width=100%>







<tr>
<td valign=top bgcolor='#cccccc' colspan=2><font face=verdana size=1>
<center>
<br><center><table width=95% cellpadding=0  border=0 bgcolor='000000'><tr>
<td width=100%>
<table width=100% cellpadding=2 cellspacing=1 bgcolor='efefef' border=0><tr>
<td width=100%>
<font class=mainhead>All your personal information will be treated in the strictest of confidence and will only be available to the orgranizers! 
</td></tr></table></td></tr></table>
<br>
</td>
</tr>








<tr>
<td colspan=2><font face=verdana size=1>
<b> Unique Details >>></b><br><hr>
<br>
</td>
</tr>







<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Username
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='loginuser' value='$loginuser'> <font> 3 characters minimum
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Password
</td>
<td width=400 valign=top>
<input class='tbox' type='password' name='pass1' value='$pass1' > <font><b>5 characters minimum </b>
</td>
</tr>








<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Confirm Password
</td>
<td width=400 valign=top>
<input class='tbox' type='password' name='pass2' value='$pass2'> <font><b>Again</b>
</td>
</tr>








<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Email
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='mail1'  value='$mail1' > <font> Valid Email
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Confirm Email
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='mail2' value='$mail2' > <font> Again<br><br>
<center>
<br><center><table width=95% cellpadding=0  border=0 bgcolor='000000'><tr>
<td width=100%>
<table width=100% cellpadding=2 cellspacing=1 bgcolor='efefef' border=0><tr>
<td width=100%><font class=mainhead>Below options should now become available if above is correct!
</td></tr></table></td></tr></table>
</td>
</tr>







<tr>
<td colspan=2><font face=verdana size=1>
<br><br><b> Personal Details >>></b><br><hr>
<br>
</td>
</tr>








<tr>
<td colspan=2 valign=top bgcolor='#cccccc'>
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Full Name : 
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='realname' value='$realname'><font> 5 Characters minimum
</td>
</tr>







<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Age
</td>
<td width=400 valign=top>
<select name=age >";





for ($io=8;$io<90;$io++){

print "<option value=$io>$io</option>";

}









print "
</select>
</td>
</tr>






<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Address
</td>
<td width=400 valign=top>
<textarea  class='text' cols=40 rows=5 name=address  value='$address' ></textarea> <font> 15 characters minimum
</td>
</tr>






<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Telephone Number
</td>
<td width=400 valign=top>
<input class='tbox' type=text name=telephone value='$telephone' ><font> 7 characters minimum
<br><font face=verdana size=1> ie. 00 353 21 4848576
<br><br>
</td>
</tr>





<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Date Of Birth<br> eg 24-12-02
</td><td width=400 valign=top>";



?>



<select name=day >

<script language=javascript>
for (x=1;x<32;x++){
document.write("<option value='" + x + "'>" + x + "</option>");
}
</script>
</select> - 
<select name=month >
<script language=javascript>
for (x=1;x<13;x++){
document.write("<option value='" + x + "'>" + x + "</option>");
}
</script>

</select> - 
<select name=year >
<script language=javascript>
for (x=1996;x>1900;x--){
document.write("<option value='" + x + "'>" + x + "</option>");
}
</script>
</select>
<br><br>



<?php



print "

</td>
</tr>


<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Country
</td>
<td width=400 valign=top><font face=verdana size=1
<select name=country >
<option value='other'> -- Other --</option>
<option value='Ireland'> Ireland </option>
<option value='England'> England </option>
<option value='Wales'> Wales </option>
<option value='Scotland'> Scotland </option>
</select>
<br><br></td>
</tr>







<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
County
</td>
<td width=400 valign=top><font face=verdana size=1>
<select name=county >
  <option value='other'> -- Other --</option>
  <option value='Antrim'> Antrim</option>
  <option value='Armagh'> Armagh</option>
  <option value='Carlow'> Carlow</option>
  <option value='Cavan'> Cavan</option>
  <option value='Clare'> Clare</option>
  <option value='Cork'> Cork</option>
  <option value='Derry'> Derry</option>
  <option value='Donegal'> Donegal</option>
  <option value='Down'> Down</option>
  <option value='Dublin'> Dublin</option>
  <option value='Fermanagh'> Fermanagh</option>
  <option value='Galway'> Galway</option>
  <option value='Kerry'> Kerry</option>
  <option value='Kildare'> Kildare</option>
  <option value='Kilkenny'> Kilkenny</option>
  <option value='Laois'> Laois</option>
  <option value='Leitrim'> Leitrim</option>
  <option value='Limerick'> Limerick</option>
  <option value='Longford'> Longford</option>
  <option value='Louth'> Louth</option>
  <option value='Mayo'> Mayo</option>
  <option value='Meath'> Meath</option>
  <option value='Monaghan'> Monaghan</option>
  <option value='Offaly'> Offaly</option>
  <option value='Roscommon'> Roscommon</option>
  <option value='Sligo'> Sligo</option>
  <option value='Tipperary'> Tipperary</option>
  <option value='Tyrone'> Tyrone</option>
  <option value='Waterford'> Waterford</option>
  <option value='Westmeath'> Westmeath</option>
  <option value='Wexford'> Wexford</option>
  <option value='Wicklow'> Wicklow</option>
  </select>
<br><br>
</td>
</tr>











<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Other 
</td>
<td width=400 valign=top><font face=verdana size=1>
<input class='tbox' type=text name=othercountry  value='$othercounty'>
</td>
</tr>
<tr>
<td colspan=2 valign=top bgcolor='#cccccc'><font face=verdana size=1>
</td>
</tr>








<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Yahoo ID
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='yahoo' value='$yahoo' >
</td>
</tr>








<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
ICQ UIN
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='icq'  value='$icq'>
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
AIM ID
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='aim'  value='$aim'>
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
MSN ID
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='msn' value='$msn' >
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
IRC Handle
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='irc' value='$irc'>
</td>
</tr>












<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
</td>
<td width=400 valign=top>
<center>
<br><center><table width=95% cellpadding=0  border=0 bgcolor='000000'><tr>
<td width=100%>
<table width=100% cellpadding=2 cellspacing=1 bgcolor='efefef' border=0><tr>
<td width=100%><font class=mainhead>Below options should now become available if above is correct!
</td></tr></table></td></tr></table>
</td>
</tr>










<tr>
<td colspan=2><font face=verdana size=1>
<br><br><b> Finish Up >>></b><br><hr>
<br>
</td>
</tr>








<tr>
<td colspan=2 valign=top bgcolor='#cccccc'>
</td>
</tr>







<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Mailing list
</td>
<td width=400 valign=top>
<select name=mailinglist >
<option value=1>Mail me</option>
<option value=0>No Mail please</option>
</select>
</td>
</tr>






<tr><td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1><br>
All Done?</td>
<td width=400 valign=top><br>
<input class='tbox' name='doitbaby' type='submit' value='Sign me up'>
</td></tr></table></form>";



intersection("Users Online");
print "<table cellpadding=3 cellspacing=0 border=0><tr><td><font>";
$query1 = $stream->do_query("select id,username from site_users where loggedin=1 order by username desc","array");
$shit = count($query1);
if($shit>0){
print "Members Online :";
}
else {
print "No Members Online!";
}
for ($g=0;$g<count($query1);$g++){
$tmp = $query1[$g];
$id = $tmp[0];
$usr = $tmp[1];
print "<b> <a href='players.php?code=member&id=$id'>$usr</a></b>";
if($g!=$shit-1){
print ",";
}
}
print "<br>";
print "</td></tr></table></TD><TD width=4></TD></TR><TR><TD></TD><TD>";				
print "</TD><TD></TD></TR></TBODY></TABLE></CENTER>";
$right = $stream->do_query("select pagecontents from site_english where pagename='t-right'","one");
echo($right);
include("lastpoll.php");
$footer = $stream->do_query("select pagecontents from site_english where pagename='t-footer'","one");
echo($footer);
die();
}






function checkup($loginuser,$realname,$pass1,$pass2,$age,$dob,$address,$telephone,$country,$county,$other,$yahoo,$msn,$irc,$icq,$aim,$mailinglist,$loggedin){

global $stream;
$y=0;


$illegal2 = array("#","!","\"","£","$","%","^","&","*","=","+","{","}","'",";",":","\\","|");
for($p=0;$p<count($illegal2);$p++){
$char = $illegal2[$p];
if(stristr("$email","$char")) {
$msg .= "Your email address contains the illegal character $char<br>";
$mail1 = "";
$mail2 = "";
$y++;
}
}



$fuck1 = $stream->do_query("select user_email from phpbb_users WHERE user_email ='$mail1'","one");
$fuck2 = $stream->do_query("select email from site_users WHERE email='$mail1'","one");
$userdude = $loginuser;
$siteusers = $stream->do_query("select username from site_users","array");
for($p=0;$p<count($siteusers);$p++){
$tmpa = $siteusers[$p];
$u1 = strtolower($tmpa[0]);
$shit = strtolower($loginuser);
if($u1==$shit){
$msg .= "Your Username has already been taken on the site<br>";
$y++;
$loginuser = "";
break;
}
}

$phpbbusers = $stream->do_query("select username from phpbb_users","array");
for($a=0;$a<count($phpbbusers);$a++){
$tmpa = $phpbbusers[$a];
$u1 = strtolower($tmpa[0]);
$shit = strtolower($loginuser);
if($u1==$shit){
$msg .= "Your Username has already been taken on the forums<br>";
$y++;
$loginuser = "";
break;
}
}


$back = "<br><a href='javascript:history.back(-1)'>Go back</a>";
$illegal = array("#","!","\"","£","$","%","^","&","*","+","_","{","}","@","'",";",":","\\","|");

for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$loginuser");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg = "Your username contains the illegal character $char<br>";
$y++;
$loginuser = "";
}
}
}


for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$realname");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your full name contains the illegal character $char<br>";
$y++;
$realname = "";

}
}
}


for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$pass1");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your password contains the illegal character $char<br>";
$y++;
$pass1 = "";
$pass2 = "";

}
}
}




for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$address");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your address contains the illegal character $char<br>";
$y++;
$address = "";
}
}
}



for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$telephone");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your telphone number contains the illegal character $char<br>";
$y++;
$telephone = "";
}
}
}


for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$other");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your other place contains the illegal character $char<br>";
$y++;
$other = "";
}
}
}



for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$yahoo");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your yahoo id contains the illegal character $char<br>";
$y++;
$yahoo= "";
}
}
}



for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$msn");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your msn id contains the illegal character $char<br>";
$y++;
$msn = "";
}
}
}



for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$irc");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your irc handle contains the illegal character $char<br>";
$y++;
$irc = "";
}
}
}



for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$icq");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your icq contains the illegal character $char<br>";
$y++;
$icq = "";
}
}
}



for($p=0;$p<count($illegal);$p++){
$char = $illegal[$p];
$check = array("$aim");
for($k=0;$k<count($check);$k++){
if(stristr("$check[$k]","$char")) {
$msg .= "Your Aol Instant messgenger contains the illegal character $char<br>";
$y++;
$aim = "";
}
}
}



if(strlen($pass1)>4){
$len = "good";
}
else {
$msg .= "Your password is too short <br>";
$y++;
$pass1 = "";
$pass2 = "";
}


if($pass1==$pass2){
$pass = md5($pass1);
}
else {
$msg .= "Your passwords are too short<br>";
$y++;
$pass1 = "";
$pass2 = "";
}


$fuck1 = $stream->do_query("select user_email from phpbb_users WHERE user_email ='$mail1'","one");
$fuck2 = $stream->do_query("select email from site_users WHERE email='$mail1'","one");

if($mail1==$fuck1){
$msg .= "Your Email address matches one already in our phpbb database<br>";
$y++;
$mail1 = "";
}

if($mail1==$fuck2){
$msg .= "Your Email address matches one already in our site database<br>";
$y++;
$mail1 = "";
}

if(strlen($mail1)<7){
$msg .= "Your Email address is way to short<br>";
$y++;
$mail1 = "";
}
if(!stristr($mail1,"@")){
$msg .= "Your Email address is no valid<br>";
$y++;
$mail1 = "";
}






if($y>0){
redoform($msg,$loginuser,$realname,$pass1,$pass2,$age,$dob,$address,$telephone,$country,$county,$other,$yahoo,$msn,$irc,$icq,$aim,$mailinglist,$loggedin);
}
}


?>