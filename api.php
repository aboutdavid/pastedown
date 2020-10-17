<?php
$file = fopen("database.json","c+");
$dbobj = fread($file,filesize("database.json"));

$db = json_decode($dbobj, true);

$db["key1"] = "value1";
$db["key2"] = "value1";
$db["key3"] = "value1";

echo var_dump($db) . "<br><br>";
$encoded = json_encode($db);
echo $encoded;
file_put_contents($file,$encoded);
fclose($file);
?>