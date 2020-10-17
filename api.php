<?php
$file = fopen("database.json","r+");
$jsonobj = fread($file,filesize("database.json"));

$arr = json_decode($jsonobj, true);

echo $arr["v1"];
echo $arr["v2"];
echo $arr["v3"];
?>