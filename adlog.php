<?php


if($url){



if($fp = fopen("./ads/$url.gif.txt",r)){
$chunk = fread($fp,filesize("./ads/$url.gif.txt"));
$varss = explode("|",$chunk);
$url = $varss[0];
$name = $varss[1];
$target = $varss[2];
$clicks = $varss[3];
$shown = $varss[4];
}
else {
print "nope";
}
fclose($fp);

if($fp1 = fopen("./ads/$url.gif.txt",w)){
$clicks = $clicks+1;
$contents = "$url|$name|$target|$clicks|$shown";
fwrite($fp1,$contents);
}
else {
print "nope";
}
fclose($fp1);


?>

<script language=javascript>

onload = document.location.href='<?php print "http://$url"; ?>';

</script>

<?php

}

else {
?>

<script language=javascript>

onload = document.location.href='http://www.megalan.net/index.php';

</script>

<?php
}




?>