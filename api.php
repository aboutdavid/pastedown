<?php
$file = fopen("database.json","r+");
$jsonobj = fread($file,filesize("database.json"));

$arr = json_decode($jsonobj, true);

$arr["v1"] = "test1"
$arr["v2"] = "test2"
$arr["v3"] = "test3"

echo $arr["v1"];
echo $arr["v2"];
echo $arr["v3"];



$save = json_encode($arr);
fwrite($file,$save);
fclose($file);
?>