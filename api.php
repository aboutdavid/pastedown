<?php
$file = fopen("database.json","w+");
$dbobj = fread($file,filesize("database.json"));

$db = json_decode($dbobj, true);

$db["key"] = "value";


$encoded = json_encode($db);
echo $encoded;
fwrite($file,$encoded);
fclose($file);
?>