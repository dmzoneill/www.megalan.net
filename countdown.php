
<script language="JavaScript1.2">

//Dynamic countdown Script II- ?Dynamic Drive (www.dynamicdrive.com)
//Support for hour minutes and seconds added by Chuck Winrich (winrich@babson.edu) on 12-12-2001
//For full source code, 100's more DHTML scripts, visit http://www.dynamicdrive.com

function setcountdown(theyear,themonth,theday,thehour,themin,thesec){
yr=theyear;mo=themonth;da=theday;hr=thehour;min=themin;sec=thesec
}

//////////CONFIGURE THE COUNTDOWN SCRIPT HERE//////////////////

//STEP 1: Configure the countdown-to date, in the format year, month, day, hour(0=midnight,23=11pm), minutes, seconds:
setcountdown(2003,04,19,11,59,59)

//STEP 2: Change the two text below to reflect the occasion, and message to display on that occasion, respectively
var occasion="MegaLan"
var message_on_occasion="MegaLan!"

//STEP 3: Configure the below 5 variables to set the width, height, background color, and text style of the countdown area
var countdownwidth='520px'
var countdownheight='35px'
var countdownbgcolor=''
var opentags='<font face="Verdana"><small>'
var closetags='</small></font>'

//////////DO NOT EDIT PAST THIS LINE//////////////////

var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
var crosscount=''

function start_countdown(){
if (document.layers)
document.countdownnsmain.visibility="show"
else if (document.all||document.getElementById)
crosscount=document.getElementById&&!document.all?document.getElementById("countdownie") : countdownie
countdown()
}

if (document.all||document.getElementById)
document.write('<span id="countdownie" style="width:'+countdownwidth+'; background-color:'+countdownbgcolor+'"></span>')

window.onload=start_countdown


function countdown(){
var today=new Date()
var todayy=today.getYear()
if (todayy < 1000)
todayy+=1900
var todaym=today.getMonth()
var todayd=today.getDate()
var todayh=today.getHours()
var todaymin=today.getMinutes()
var todaysec=today.getSeconds()
var todaystring=montharray[todaym]+" "+todayd+", "+todayy+" "+todayh+":"+todaymin+":"+todaysec
futurestring=montharray[mo-1]+" "+da+", "+yr+" "+hr+":"+min+":"+sec
dd=Date.parse(futurestring)-Date.parse(todaystring)
dday=Math.floor(dd/(60*60*1000*24)*1)
dhour=Math.floor((dd%(60*60*1000*24))/(60*60*1000)*1)
dmin=Math.floor(((dd%(60*60*1000*24))%(60*60*1000))/(60*1000)*1)
dsec=Math.floor((((dd%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1)
//if on day of occasion
if(dday<=0&&dhour<=0&&dmin<=0&&dsec<=1&&todayd==da){
if (document.layers){
document.countdownnsmain.document.countdownnssub.document.write(opentags+message_on_occasion+closetags)
document.countdownnsmain.document.countdownnssub.document.close()
}
else if (document.all||document.getElementById)
crosscount.innerHTML=opentags+message_on_occasion+closetags
return
}
//if passed day of occasion
else if (dday<=-1){
if (document.layers){
document.countdownnsmain.document.countdownnssub.document.write(opentags+"Occasion already passed! "+closetags)
document.countdownnsmain.document.countdownnssub.document.close()
}
else if (document.all||document.getElementById)
crosscount.innerHTML=opentags+"Occasion already passed! "+closetags
return
}
//else, if not yet
else{
if (document.layers){
document.countdownnsmain.document.countdownnssub.document.write(opentags+dday+ " days, "+dhour+" hours, "+dmin+" minutes, and "+dsec+" seconds left until "+occasion+closetags)
document.countdownnsmain.document.countdownnssub.document.close()
}
else if (document.all||document.getElementById)
crosscount.innerHTML=opentags+dday+ " days, "+dhour+" hours, "+dmin+" minutes, and "+dsec+" seconds left until "+occasion+closetags
}
setTimeout("countdown()",1000)
}
</script>
<center>
<ilayer id="countdownnsmain" width=&{countdownwidth}; height=&{countdownheight}; bgColor=&{countdownbgcolor}; visibility=hide><layer id="countdownnssub" width=&{countdownwidth}; height=&{countdownheight}; left=50 top=0></layer></ilayer></td></tr></table>