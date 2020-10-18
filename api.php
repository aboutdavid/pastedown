<?php
$file = file_get_contents("database.json");
$paste = trim($_REQUEST['paste']);
$ini = parse_ini_file('config.ini');
if (empty($paste)) {
  echo "empty";
  die();
}
$n = 5;
// Do some string generation
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 


$db = json_decode($file, true);

$db[$randomString] = $paste;

$encoded = json_encode($db);

$fileobj = fopen("database.json", 'w');
fwrite($fileobj,$encoded);
fclose($fileobj);
echo $randomString;
?>