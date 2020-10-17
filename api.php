<?php
$file = fopen("database.json","r+");
$jsonobj = fread($file,filesize("database.json"));

$arr = json_decode($jsonobj, true);

$arr["key1"] = "value1";
$arr["key2"] = "value2";
$arr["key3"] = "value3";

echo $arr["v1"];
echo $arr["v2"];
echo $arr["v3"];


$save = json_encode($arr);
fwrite($file,$save);
fclose($file);
?>