<?php
$ini = parse_ini_file('config.ini');
$paste = $_REQUEST['paste'];
$id = $_REQUEST['id'];
$bypass_captcha = true;
$edit_code = $_REQUEST['edit_code'];
if ($paste === null or $paste === "") {
  http_response_code(400);
  echo "You can't have an empty paste.";
  die();
}
$token = $_REQUEST['token'];
$action = $_REQUEST['action'];
// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $ini['recaptcha_private'], 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);
// verify the response
if($arrResponse["success"] == true && $arrResponse["score"] >= 0.0 && $ini['visibility'] == "public" || $bypass_captcha === false) {
$file = file_get_contents("database.json");

$n = 7;
// Do some string generation
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
$y = 12;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $editCode = ''; 
  
    for ($i = 0; $i < $y; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $editCode .= $characters[$index]; 
    } 


$db = json_decode($file, true);
if ($edit_code) {
  $randomString == $id;
}
if ($edit_code !== $db["pastes"][$id]["edit_code"]){
  echo "Wrong edit code!";
  http_response_code(403);
  die();
}
$db["pastes"][$randomString]["content"] = $paste;
$db["pastes"][$randomString]["edit_code"] = $editCode;

$encoded = json_encode($db);

$fileobj = fopen("database.json", 'w');
fwrite($fileobj,$encoded);
fclose($fileobj);
header("Location: /paste/" . $randomString .  "?ec=" . $editCode);
exit();
  
} else {
echo "We think you might be a robot. Please try again later.";
if ($arrResponse["score"]){
  echo " Robot score: " . $arrResponse["score"] . "/1.0 (1.0 is most likely a human and 0.0 is most likely a bot. The minimum threshold to use our site is 0.5)";
}
http_response_code(429);
die();
}
?>