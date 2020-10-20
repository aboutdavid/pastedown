<?php
$ini = parse_ini_file('config.ini'); // Parse config.ini file
$paste = $_REQUEST['paste']; // Get paste content
$id = $_REQUEST['id']; // Get ID (only for editing)
$edit_code = $_REQUEST['edit_code']; // Get the edit code (only for editing)
if ($paste === null or $paste === "") {
  http_response_code(400);
  echo "You can't have an empty paste.";
  die();
}
$token = $_REQUEST['token']; // Google ReCaptchav3
$action = $_REQUEST['action']; // Google ReCaptchav3
// call curl to POST request
$ch = curl_init(); // Start cURL
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify"); // Set the cURL URL.
curl_setopt($ch, CURLOPT_POST, 1); // Choose method
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $ini['recaptcha_private'], 'response' => $token))); // Add fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch); // Send the request
curl_close($ch); // Close the request
$arrResponse = json_decode($response, true); // Set the response 
// verify the response
if($arrResponse["success"] == true && $arrResponse["score"] >= 0.0 && $ini['visibility'] == "public") { // Verify that the user is not a robot
$file = file_get_contents("database.json"); // Read the database

$n = 7;
$y = 12;
// Generate a random paste id ($n)
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';  
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
// Generate a random edit code ($y)
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $editCode = ''; 
  
    for ($i = 0; $i < $y; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $editCode .= $characters[$index]; 
    } 

// Decode the JSON database
$db = json_decode($file, true);
if ($edit_code && $edit_code !== $db["pastes"][$id]["edit_code"]){ // If there is an edit code and it does not match the one it the datebase, stop. Else, proceed.
  echo "Wrong edit code!";
  http_response_code(403);
  die();
} else {
  $randomString = $id; // If checking succeeds, set the random string to the ID in the URL
  $editCode = $edit_code; // If checking succeds, set the edit code to the one in the URL
}
$db["pastes"][$randomString]["content"] = $paste; // Set the content to the one in the URL
$db["pastes"][$randomString]["edit_code"] = $editCode; // Set the edit code to the randomly generated one or the one in the URL
$db["pastes"][$randomString]["views"] = 0; // Set views to 0.

$encoded = json_encode($db); // Re-encode database

$fileobj = fopen("database.json", 'w'); // Open the database
fwrite($fileobj,$encoded); // Write to the database
fclose($fileobj); // Close the database
header("Location: /paste/" . $randomString); // Redirect the user to the string URL

  
} else {
echo "We think you might be a robot. Please try again later."; // Send robot response if user is robot
if ($arrResponse["score"]){
  echo " Robot score: " . $arrResponse["score"] . "/1.0 (1.0 is most likely a human and 0.0 is most likely a bot. The minimum threshold to use our site is 0.5)"; // If a gcaptcha score is present, send it to the user.
}
http_response_code(429); // Send a "Too many requests (429)" HTTP error 
die(); // Exit the program on "robot"
}
die(); // Exit the program.
?>