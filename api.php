<?php
$file = file_get_contents("database.json");
$paste = $_REQUEST['paste'];
$ini = parse_ini_file('config.ini');
$n = 100;
// Do some string generation
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 


$db = json_decode($file, true);

$db[$randomString] = $paste;


echo var_dump($db) . "<br><br>";
$encoded = json_encode($db);
echo $encoded;
$fileobj = fopen("database.json", 'w');
fwrite($fileobj,$encoded);
fclose($fileobj);
?>