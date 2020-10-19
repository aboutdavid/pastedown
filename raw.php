<?php
require __DIR__ . '/vendor/autoload.php';
$ini = parse_ini_file('config.ini');
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);
$file = file_get_contents("database.json");
$db = json_decode($file, true);
if (!$db["pastes"][$_REQUEST['id']]["content"]){
http_response_code(404);
echo "That paste was not found!";
exit();
}
header('Content-type: text/plain');
echo $db["pastes"][$_REQUEST['id']]["content"];
?>