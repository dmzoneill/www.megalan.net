<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?php

$die = "./mint";

if ($dir = @opendir($die)) {
  while (($file = readdir($dir)) !== false) {
  if(is_dir($file){
  
  }
  else {
    echo "<img src='$die/$file'><br>";
  }  
  }
  closedir($dir);
}



?>

</body>
</html>
