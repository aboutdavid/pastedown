<?php
$file = file_get_contents("database.json");
$paste = $_SERVER['paste'];
$db = json_decode($file, true);

$db["key1"] = "value1";
$db["key2"] = "value1";
$db["key5"] = "value1";

echo var_dump($db) . "<br><br>";
$encoded = json_encode($db);
echo $encoded;
$fileobj = fopen("database.json", 'w');
fwrite($fileobj,$encoded);
fclose($fileobj);
?>