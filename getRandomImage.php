<?php  

// print a random image.  Don't forget ending slash!
// setting $type to 'all' will return all images.

$img = getRandomImage('./ads/');

// url, imagename, target, clicks, shown

if($fp = fopen("$img.txt",r)){
$chunk = fread($fp,filesize("$img.txt"));
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


print "<a href='http://www.megalan.net/adlog.php?url=$url' target='$target'><img width='468' height='60' vspace='0' hspace='0' alt='$name' src='$img' border='0'></a>";









function getRandomImage($dir,$type='random')

{ 

global $errors; 



  if (is_dir($dir)) {  



  $fd = opendir($dir);  

  $images = array(); 



      while (($part = @readdir($fd)) == true) {  



      clearstatcache();



          if ( eregi("(gif|jpg|png|jpeg)$",$part) ) {

              $images[] = $part; 

          } 

      } 



    // adding this in case you want to return the image array

    if ($type == 'all') { return $images; }



    // Be sure to call srand() once per script

    srand ((double) microtime() * 1000000); 

    $key = rand (0,sizeof($images)-1); 



    return $dir . $images[$key]; 



  } else { 

      $errors[] = $dir.' is not a directory'; 

      return false; 

  } 

} 



?>