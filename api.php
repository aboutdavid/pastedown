<?php
$file = file_get_contents("database.json");

$db = json_decode($file, true);

$db["key1"] = "value1";
$db["key2"] = "value1";
$db["key3"] = "value1";

echo var_dump($db) . "<br><br>";
$encoded = json_encode($db);
echo $encoded;
$fileobj = fopen("data_out.json", 'w')
file_put_contents($fileobj,$encoded);
fclose($fileobj);
?>