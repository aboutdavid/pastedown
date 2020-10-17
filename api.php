<?php
$file = fopen("database.json","w+");
$dbobj = fread($file,filesize("database.json"));

$db = json_decode($dbobj, true);

$db["key1"] = "value1";
$db["key2"] = "value1";
$db["key3"] = "value1";

$encoded = json_encode($db);
echo $encoded;
fwrite($file,$encoded);
fclose($file);
?>