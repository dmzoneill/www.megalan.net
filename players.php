<?php

ob_start("ob_gzhandler");
include("connect.php");
include("functions.php");
include("track.php");

sheader("Megalan.net Players List","Megalan.net Players List");

			
			
				
$page = $stream->do_query("select pagecontents from site_english where pagename='players'","one");				
print $page;


switch($code){


default :

$query1 = $stream->do_query("select * from site_users where rank>0 order by id DESC","array");

for ($t=0;$t<count($query1);$t++){

$tmp = $query1[$t];
$id = $tmp[0];
$username = $tmp[1];
$name = $tmp[2];
$payed = $tmp[20];

print "<center><font>Welcome to our newest member <a href='players.php?code=member&id=$id'>$username</a><br><br>";
break;

}

print "<center><a href='#a'>A</a> | <a href='#b'>B</a> | <a href='#c'>C</a> | 
<a href='#d'>D</a> | <a href='#e'>E</a> | <a href='#f'>F</a> | <a href='#g'>G</a> | <a href='#h'>H</a> | 
<a href='#i'>I</a> | <a href='#j'>J</a> | <a href='#k'>K</a> | <a href='#l'>L</a> | <a href='#m'>M</a> |
<a href='#n'>N</a> | <a href='#o'>O</a> | <a href='#p'>P</a> | <a href='#q'>Q</a> | <a href='#r'>R</a> | 
<a href='#S'>S</a> | <a href='#t'>T</a> | <a href='#u'>U</a> | <a href='#v'>V</a> | <a href='#w'>W</a> | 
<a href='#x'>X</a> | <a href='#y'>Y</a> | <a href='#z'>Z</a> ";


$query1 = $stream->do_query("select * from site_users where rank>0 order by username ASC","array");
$shit = count($query1);

print "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\"><tr><td>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\"><tr><td colspan=2>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
  <tr>
    <td><center><font class=mainhead>
Currently there are <b>$shit</b> Megalan.net Members
</td></tr></table>
</td></tr><tr>
<td><font><b>Megalan Member</td><td><font><b>Registered</td></tr>";

$query1 = $stream->do_query("select * from site_users where rank>0 order by username ASC","array");

$j=0;

for ($x=0;$x<count($query1);$x++){
$tmp = $query1[$x];
$id = $tmp[0];
$username = $tmp[1];
$name = $tmp[2];
$payed = $tmp[20];
$time = getdate($tmp[24]);
$todayp = getdate(time());
$timep = "$time[weekday] the $time[mday] of $time[month], $time[year]";
$today = "$time[weekday] $time[mday] $time[month] $time[year]";

if(stristr("$today","$todayp[weekday]")){
if(stristr("$today","$todayp[mday]")){
if(stristr("$today","$todayp[month]")){
$j++;
}
}
}


$nametohigher = ucfirst($username);
$firstchar = substr($nametohigher, 0,1);

if($x<1){
print "<tr><td><a name='$firstchar'><font class=mainhead>$firstchar</a></td><td></td></tr>";
$passchar = substr($nametohigher, 0,1);
}
else {
if($passchar!=$firstchar){
print "<tr><td><a name='$firstchar'><font class=mainhead>$firstchar</a></td><td></td></tr>";
$passchar = substr($nametohigher, 0,1);
}
else {
print "";
$passchar = substr($nametohigher, 0,1);
}
}




print "<tr><td><font><a href='players.php?code=member&id=$id'>$username</a> ($name) </td><td><font> ($timep)</td></tr>";
}

print "</table></td></tr></table>";

print "<center><br><font class=mainhead>Total of $j Registrants today</font><br><br>";
		
break;









case "member":

$queryg = $stream->do_query("select * from site_users where id='$id'","array");

for ($x=0;$x<count($queryg);$x++){
$tmp = $queryg[$x];
$id = $tmp[0];
$username = $tmp[1];
$name = $tmp[2];
$age = $tmp[4];
$dob = $tmp[5];
$country = $tmp[8];
$county = $tmp[9];
$other = $tmp[10];
$email = $tmp[11];
$yahoo = $tmp[12];
$msn = $tmp[13];
$irc = $tmp[14];
$icq = $tmp[15];
$aim = $tmp[16];
$picture = $tmp[22];
$rank = $tmp[23];
$regdate = $tmp[24];

if($picture==""){
$picture= "img/default.jpg";
}

$refresh = "<font>Redirecting...<script language=javascript>\n setTimeout(\"document.location.href='staff.php';\", 800); \n </script>";

if($username=="Shad0r"){
print $refresh;
break;
}
if($username=="Proxykillah"){
print $refresh;
break;
}
if($username=="amp"){
print $refresh;
break;
}
if($username=="DeVore"){
print $refresh;
break;
}
if($username=="BioHazRd"){
print $refresh;
break;
}


print "<table width=100% border=0 cellspacing=0 cellpadding=3>
  <tr>
    <td align=center valign=top><p>&nbsp;</p><center>
      <table width=400 border=0 cellspacing=0 cellpadding=0>
        <tr> 
          <td height=304 align=left valign=top bgcolor=#222222><table width=400 border=0 cellpadding=0 cellspacing=2>
              <tr> 
                <td width=60 rowspan=2 align=left valign=top><img src=img/membertitle.gif width=60 height=300></td><td align=left valign=top><img vspace=0 hspace=0 src=$picture width=71 height=100></td><td width=100% align=left valign=top bgcolor=#CCCCCCC><div align=center><br>
                    <font><strong>Name:</strong> $name ($username)</font><br>
                  </div></td></tr>
              <tr> 
                <td colspan=2 align=left valign=top bgcolor=#CCCCCC><table width=100% border=0 cellspacing=0 cellpadding=2>
                    <tr> 
                      <td align=left valign=top><p><font>
					  <font>
					  <b>Age</b> : $age<br>
					  <b>Location</b> : $county, $country<br>
					  <b>Other</b> : $other<br>
					  <br>
					  <b>Contact Details</b><br>
					  <b>Msn </b>: $msn<br>
					  <b>Irc Handle </b>: $irc<br>
					  <b>Aol IM</b> : $aim<br>
					  <b>Icq No.</b> : $icq<br>
					  <b>Yahoo </b> : $yahoo<br><br>
					  
					  <b>Private Message </b> : <a href='http://www.megalan.net/member-cp.php?control=private&send=start&user=$id'>Send Private messsage to $username<br>
									  
					  </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>

      </td>
  </tr>
</table>";

}

break;

}







footer();

?>