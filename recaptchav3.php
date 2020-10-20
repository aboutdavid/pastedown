<?php
$ini = parse_ini_file('config.ini');
$paste = $_REQUEST['paste'];
$id = $_REQUEST['id'];
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
if($arrResponse["success"] == true && $arrResponse["score"] >= 0.0 && $ini['visibility'] == "public") {
 require './api.php';
  
} else {
echo "We think you might be a robot. Please try again later.";
if ($arrResponse["score"]){
  echo " Robot score: " . $arrResponse["score"] . "/1.0 (1.0 is most likely a human and 0.0 is most likely a bot. The minimum threshold to use our site is 0.5)";
}
http_response_code(429);
die();
}
?>