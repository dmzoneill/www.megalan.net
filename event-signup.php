<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");


if(!$printable){
sheader("MegaLan.net Lan Signup Form","MegaLan.net Lan Signup Form");
}
	
if(validatecookie($msg)==1){
	
$fuck1 = $stream->do_query("select username from site_lansignup WHERE username='$cookieuser'","one");
			
if($fuck1!=$cookieuser){

switch($lan){

default:


print "<body onload='javascript:document.adduser.doit.disabled=true;document.adduser.amover18.disabled=true;document.adduser.haveread.disabled=true;'><font>";			

?>

<script>
var MAX_ALLOWED=3;
var clickedData=new Array(false,false,false,false,false,false,false,false,false,false,false,false);
function itemsClicked(){
var i=0;
  if(document.showit.s1.value<3){
document.adduser.amover18.disabled=true;
document.adduser.haveread.disabled=true;
document.adduser.doit.disabled=true;
  }
for(var j=0;j<clickedData.length;j++)i+=clickedData[j]?1:0;return(i);
}

function itemClicked(_v){
  var ALLOW_THIS=true;
  var x=itemsClicked();
  if (x>=MAX_ALLOWED && !clickedData[_v]){
    ALLOW_THIS=false;
document.adduser.amover18.disabled=true;
document.adduser.haveread.disabled=true;
document.adduser.doit.disabled=true;
  }
  else
  {
    clickedData[_v]=clickedData[_v]?false:true;
	eval("document.adduser.r"+_v+".clicked=false;");
  }
  document.showit.s1.value=x; /* comment out */

if(document.showit.s1.value==MAX_ALLOWED-1){
document.adduser.amover18.disabled=false;
document.adduser.haveread.disabled=false;
}

else {
document.adduser.amover18.disabled=true;
document.adduser.haveread.disabled=true;
document.adduser.doit.disabled=true;
}

return (ALLOW_THIS); /* kill the event handler */
}


function check(){
if(document.adduser.amover18.checked=true){
document.adduser.haveread.checked=false;
document.adduser.doit.disabled=false;
}
}

function check1(){
if(document.adduser.haveread.checked=true){
document.adduser.amover18.checked=false;
document.adduser.doit.disabled=false;
}
}

</script>

<?php


print "It is critical that you fill out this form correctly for billing purposes!<br>";
print "All payments will done via post!";



$query = $stream->do_query("select * from site_users where username='$cookieuser'","array");

for ($x=0;$x<count($query);$x++){

$tmp = $query[$x];
$id = $tmp[0];
$username = $tmp[1];
$realname = $tmp[2];
$age = $tmp[4];
$dob = $tmp[5];
$address = $tmp[6];
$telephone = $tmp[7];
$country = $tmp[8];
$county = $tmp[9];
$other = $tmp[10];
$email = $tmp[11];



print "<br><br><b> Part 1 >>></b><br><hr>
<form name=showit>
<input class='tbox' type=hidden name=s1 value=0>
</form>
<form name=adduser action='event-signup.php?lan=adduser' method='post'>

<table cellpadding=2 cellspacing=0 border=0 width=100%>
<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Username

</td>

<td width=400 valign=top>
<font>
$username

</td>

</tr>

<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Full Name

</td>

<td width=400 valign=top>

<input class='tbox' type='text' value='$realname' name='realname'>

</td>

</tr>
<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Email

</td>

<td width=400 valign=top>

<input class='tbox' type='text' value='$email' name='mail'>

</td>

</tr>
<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Age

</td>

<td width=400 valign=top>
<input class='tbox' type='text' value='$age' name='age'>
</td>

</tr>

<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Address

</td>

<td width=400 valign=top>

<textarea class='text' cols=40 rows=5 name=address>$address</textarea>

</td>

</tr>
<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Telephone Number

</td>

<td width=400 valign=top>

<input class='tbox' type='text' value='$telephone' name='telephone'><br><font> ie. + 353 21 4222174

<br><br>

</td>

</tr>
<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Date Of Birth<br> eg 24-12-02

</td>

<td width=400 valign=top>

<input class='tbox' type='text' value='$dob' name='dob'>

</td>

</tr>


<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Country

</td>

<td width=400 valign=top><font>

<input class='tbox' type='text' value='$country' name='country'>

</td>

</tr>

<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 County

</td>

<td width=400 valign=top><font>
<input class='tbox' type='text' value='$county' name='county'>
<br><br>
</td>

</tr>

<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Other

</td>

<td width=400 valign=top><font>
<input class='tbox' type='text' value='$other' name='other'>
<br><br>
</td>

</tr>

</table>
<br>
<br>

<b> Part 2 >>></b><br><hr>
<table cellpadding=2 cellspacing=0 border=0 width=100%>
<tr>

<td width=200 valign=top bgcolor='#cccccc'><font>

 Competitions

</td>";
?>
<td width=400 valign=top>

<font>
Please select any 3 of the following which you wish to take part in competitively<br><br>
<input class='tbox' name='r1' type=checkbox value='cs' onclick="return itemClicked(1)"> Counter Strike <br>
<input class='tbox' name='r2' type=checkbox value='dod' onclick="return itemClicked(2)"> Day of Defeat <br>
<input class='tbox' name='r3' type=checkbox value='tfc' onclick="return itemClicked(3)"> Team Fortress Classic <br>
<input class='tbox' name='r4' type=checkbox value='ns' onclick="return itemClicked(4)"> Natural Selection <br>
<input class='tbox' name='r5' type=checkbox value='q3' onclick="return itemClicked(5)"> Quake3 <br>
<input class='tbox' name='r6' type=checkbox value='ut2003' onclick="return itemClicked(6)"> Unreal Tournament 2003 <br>
<input class='tbox' name='r7' type=checkbox value='ssam' onclick="return itemClicked(7)"> Serious Sam <br>
<input class='tbox' name='r8' type=checkbox value='mohaa' onclick="return itemClicked(8)"> Medal Of Honour <br>
<input class='tbox' name='r9' type=checkbox value='jk' onclick="return itemClicked(9)"> Jedi Knight 2 <br>
<input class='tbox' name='r10' type=checkbox value='colin' onclick="return itemClicked(10)"> Colin McRae Rally 2 <br>
<input class='tbox' name='r11' type=checkbox value='fifa' onclick="return itemClicked(11)"> Fifa 2002 World Cup <br>
<input class='tbox' name='r12' type=checkbox value='rtcw' onclick="return itemClicked(12)"> Return to Castle Wolfenstein <br>
<?php

print "</td>
</tr>
<tr>
<td width=200 valign=top bgcolor='#cccccc'><font>
Clan Name
</td>

<td width=400 valign=top><font>
<input class='tbox' type='text' name='clan' value='N/A'><br>
Leave as N/A if your not part of a clan!
</td>

</tr></table>

<br><br>
<b> Part 3 >>></b><br><hr>
<table cellpadding=2 cellspacing=0 border=0 width=100%>
<tr>

<td width=200 valign=top bgcolor='#cccccc'><font><br>

 Agreement

</td>

<td width=400 valign=top><br><font>

<b>* All LAN Party disclaimers must be signed and included with event fee. </b><br><br>
<a href='event-signup.php?lan=disclaimer&printable=true' target='_blank'>Lan Party Disclaimer</a><br><br>
<input class='tbox' type='checkbox' name='amover18' onclick='check()'>I am over 18 and have read and the LAN Party disclaimer and agree to its terms.
<br><br>
<input class='tbox' type='checkbox' name='haveread' onclick='check1()'>I am less than 18 years old and both I and my parent/gaurdian have read the LAN Party disclaimer and agree to its terms.
<br><br>
<a href='event-signup.php?lan=disclaimer&printable=true' target='_blank'>Lan Party Disclaimer</a><br>

</td>
</tr>
</table>


<br><br>
<b> Finally >>></b><br><hr>
<table cellpadding=2 cellspacing=0 border=0 width=100%>
<tr>

<td width=200 valign=top bgcolor='#cccccc'><font><br>

 Finish up!

</td>

<td width=400 valign=top><br><font>

<input class='tbox' type='submit' name='doit' value=' Continue >> '>

<br><br>
Remember, your IP Address ( $iptrack )<br> is being recorded for security reasons
<br><br>

</td>

</tr>
</table>

</form>



";





}



break;



case "disclaimer":
$page = $stream->do_query("select pagecontents from site_english where pagename='terms-conditions'","one");
print $page;
break;





case "adduser":

$fucker = $stream->do_query("select username from site_lansignup WHERE username='$cookieuser'","one");

if($fucker==$cookieuser){

print "<font>Sorry $cookieuser but you've already signed up, why sign up again?";
}

else {

if(($amover18) or ($haveread)){

$stack = array();
for ($p=0;$p<12;$p++){
if(${"r$p"}){
$shit = ${"r$p"};
array_push ($stack, $shit);
}
}

$regdate = date("F j, Y");

$games = "$stack[0],$stack[1],$stack[2]";

$page = $stream->do_query("select pagecontents from site_english where pagename='paymentdetails'","one");
print $page;

$page = $stream->do_query("INSERT INTO site_lansignup VALUES ('','$cookieuser','$realname','$cookiepass','$age','$dob','$address','$telephone','$country','$county','$other','$mail','0','$games','$regdate')","one");

}
}

break;





case "done":
break;

}

}

else {
print "<br><dd><font>Dude your already signed up!<br><br>";
}

}

else {

login("event-signup.php",$fail);

}
		

	
		

if(!$printable){
footer();
}
?>