<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");
sheader("MegaLan.net Member Signup","MegaLan.net Member Signup");
	
	
include("signup-functions.php");	
	
		
	
	
	
print "<table cellpadding=3 cellspacing=0 borber=0><tr><td>";		



switch($signup){


default:


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
<input class='tbox' type='text' name='loginuser' > <font> 3 characters minimum
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Password
</td>
<td width=400 valign=top>
<input class='tbox' type='password' name='pass1' > <font><b>5 characters minimum </b>
</td>
</tr>








<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Confirm Password
</td>
<td width=400 valign=top>
<input class='tbox' type='password' name='pass2' > <font><b>Again</b>
</td>
</tr>








<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Email
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='mail1' > <font> Valid Email
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Confirm Email
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='mail2' > <font> Again<br><br>
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
<input class='tbox' type='text' name='realname' ><font> 5 Characters minimum
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
<textarea  class='text' cols=40 rows=5 name=address ></textarea> <font> 15 characters minimum
</td>
</tr>






<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
Telephone Number
</td>
<td width=400 valign=top>
<input class='tbox' type=text name=telephone ><font> 7 characters minimum
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
<input class='tbox' type=text name=othercountry >
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
<input class='tbox' type='text' name='yahoo' >
</td>
</tr>








<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
ICQ UIN
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='icq' >
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
AIM ID
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='aim' >
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
MSN ID
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='msn' >
</td>
</tr>









<tr>
<td width=200 valign=top bgcolor='#cccccc'><font face=verdana size=1>
IRC Handle
</td>
<td width=400 valign=top>
<input class='tbox' type='text' name='irc' >
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
break;







case "adduser":

checkup($loginuser,$realname,$pass1,$pass2,$age,$dob,$address,$telephone,$country,$county,$other,$yahoo,$msn,$irc,$icq,$aim,$mailinglist,$loggedin);


$userdude = $loginuser;

	
$realname = eregi_replace("\"","\\\"",$realname);
$realname = eregi_replace("'","\'",$realname);
$address = eregi_replace("\"","\\\"",$address);
$address = eregi_replace("'","\'",$address);			
				
$fucker = $stream->do_query("select user_id from phpbb_users","array");
for($r=0;$r<count($fucker);$r++){
$tmp = $fucker[$r];
$idhh = $tmp[0];
}
$phpbbuser = $idhh +1;
				

$address = htmlspecialchars($address);

$regdate = time();
$dob = "$day - $month - $year";
$yourgay = $stream->do_query("INSERT INTO site_users VALUES ('','$userdude','$realname','$pass','$age','$dob','$address','$telephone','$country','$county','$other','$email','$yahoo','$msn','$irc','$icq','$aim','$mailinglist','$loggedin','','','','','0','$regdate','')","one");
$yourgay1 = $stream->do_query("INSERT INTO phpbb_users values ('$phpbbuser','1','$userdude','$pass','0','0','0','$regdate','0','0','0.00','0','english','D M d, Y g:i a','0','0','0' , 'NULL' ,'1','1','1','1','1','1','1','1','0','1','1','0','','0','$email','$icq','','','','','$aim','$yahoo','$msn','','','','null')","one");

print "<br><font>Megalan.net is attempting to create your account!<br><br>";

$x=0;

if(stristr($yourgay,"error")){
die_nice("You have caused and error in our site by using illegal characters, please try signing up again and not using characters such as \" & \' & \\ ");
}
if(stristr($yourgay1,"error")){
die_nice("You have caused and error in our site by using illegal characters, please try signing up again and not using characters such as \" & \' & \\ ");
}


if($yourgay!="bad"){
print "<font class=mainhead>Site account created Successfully!</font><br>";
}
else {
print "<font class=mainhead>Site account was not created!</font><br>";
$x++;
}
if($yourgay1!="bad"){
print "<font class=mainhead>Forums account created Successfully!</font><br>";
}
else {
print "<font class=mainhead>Forums account was not created!</font><br>";
$x++;
}

print "<br>";

if($x>0){
print "<font class=mainhead><br><br>On or more errors above may inflict on your use of the site or forums.<br>";
print "If you wish to try your registration again please do and inform services@megalan.net of the error!<br>";
print "When you retry, remember to fill out all forms correctly and refrain from using <b>'</b> and <b> \" </b><br>";
print "Please also use a differnet username to the one you originally tried to sign up with!";
}
if($x<1){


$topic = "Registration Confirmation @ Megalan.net";
$resource = "services@megalan.net";
$message = "Thank you $realname for signing up on megalan.net. <br><br>";
$message .= "For future reference your account details are as follows<br>Username = $loginuser<br>Password = $pass2<br><br>";
$message .= "To activate your account please click the following link or copy it into the location bar of your browser<br> ";
$message .= "<a href='http://www.megalan.net/confirm.php?page=newmember&confirm=$pass'>http://www.megalan.net/confirm.php?page=newmember&confirm=$pass</a>";
$message .= "<br><br>If you have any problems with your registration please contact dave@megalan.net for troubleshooting<br><br>Dave.<br><br>";


webemail($topic,$email,$resource,$message);

print "<br><font class=mainhead>All went well with the megalan site and forums signup!<br>";
print "Note: Your username and password are the same for the site and the forums!";
}

print "<br><br>";

print "</font>";



break;

}







print "</td></tr></table>";


		

footer();

?>