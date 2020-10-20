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

?>


<!DOCTYPE html>
<html>
  <!-- Meta tags -->
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
  <!-- Primary Meta Tags -->
<title>Pastedown - a Markdown Pastebin</title>
<meta name="title" content="Pastedown - a Markdown Pastebin">
<meta name="description" content="Welcome to Pastedown! A simple Pastebin that allows Markdown. Pretty cool right?">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://pastedown.glitch.me/">
<meta property="og:title" content="Pastedown - a Markdown Pastebin">
<meta property="og:description" content="Welcome to Pastedown! A simple Pastebin that allows Markdown. Pretty cool right?">
<meta property="og:image" content="">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://pastedown.glitch.me/">
<meta property="twitter:title" content="Pastedown - a Markdown Pastebin">
<meta property="twitter:description" content="Welcome to Pastedown! A simple Pastebin that allows Markdown. Pretty cool right?">
<meta property="twitter:image" content="">
<!-- Add main CSS files -->
  <link rel="stylesheet" href="/css/halfmoon.css">
  <link rel="stylesheet" href="/css/main.css">
<link rel="stylesheet" href="/css/prism.css">
  <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
<head>
</head>

<body data-set-preferred-mode-onload="true">
    <header>
    
        <!-- Page wrapper with .with-navbar class -->
        <div class="page-wrapper with-navbar">
            <!-- Navbar (immediate child of the page wrapper) -->
            <nav class="navbar">
                <!-- Navbar content (with toggle sidebar button) -->
                <div class="navbar-content">

                </div>
                <!-- Navbar brand -->
                <a href="/" class="navbar-brand">
                    <img src="https://cdn.glitch.com/65fb0f88-4115-49b0-bcb6-88908e25d1db%2Fnotepad.svg?v=1602954032741" alt="Icon" onerror="this.style.display='none'"><?php echo $ini['brand_name']; ?>
                </a>
                <!-- Navbar nav -->
                <ul class="navbar-nav d-none d-md-flex">
                    <!-- d-none = display: none, d-md-flex = display: flex on medium screens and up (width > 768px) -->
     
                  
                </ul>
                <!-- Navbar form (inline form) -->
              <div class="navbar-content ml-auto">
                    <button class="btn btn-primary" type="button" onclick="halfmoon.toggleDarkMode();">🌙</button>
              </div>
                <!-- Navbar content (with the dropdown menu) -->
                <div class="navbar-content d-md-none ml-auto">

                </div>
            </nav>

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <div class="container-fluid">
     <?php 
    if ($db["pastes"][$_REQUEST['id']]["views"] == 0){
echo '<div style="height:250px;margin-top:-60px;position:absolute;top:90%;padding-left:5px;">To edit your pastedown, use the this edit link: <code class="code"><a href="/edit?edit_code=' . $db["pastes"][$_REQUEST['id']]["edit_code"] . "&id=" . $_REQUEST['id'] . '">' . $ini['domain'] .'/edit?edit_code=' . $db["pastes"][$_REQUEST['id']]["edit_code"] . "&id=" . $_REQUEST['id'] . '</a></code><br> or use this edit code:<code class="code">' . $db["pastes"][$_REQUEST['id']]["edit_code"] . '</code><br><b>Note:</b> Write the link and/or edit code down because you will never see it again. We use edit codes so you can edit your pastedown without a login.</div>'; 
    } else {
      echo '<div style="height:250px;margin-top:-60px;position:absolute;top:90%;padding-left:5px;">Analytics:<br><b>' . $db["pastes"][$_REQUEST['id']]["views"] .'</b> views.</div>';
    }
   ?>
    <div class="col-sm shadow" id="preview" style="outline:none;resize:none;border:none;display:block;height:60vh;margin-top:-175px;position:absolute;top:40%;overflow:auto;"><?php echo $Parsedown->text($db["pastes"][$_REQUEST['id']]["content"]); ?></div>
    <div class="btn-group" role="group" aria-label="Basic example" style="height:250px;margin-top:80px;position:absolute;top:-10%;">
<button class="btn" type="button" onclick="window.location.replace('/export/<?php echo $_REQUEST['id']; ?>')">Export</button>
<button class="btn" type="button" onclick="window.location.replace('/edit?id=<?php echo $_REQUEST['id']; ?>')">Edit</button>
<button class="btn" type="button" onclick="window.location.replace('/raw/<?php echo $_REQUEST['id']; ?>')">Raw</button>
      
</div>
</div>
            </div>
        </div>

        <!-- Requires halfmoon.js for the dropdowns -->
          <!-- Add main JS files -->
  <script src="/js/halfmoon.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/marked.js"></script>
      <script src="/js/xss.js"></script>
<script type="text/javascript">"light-mode"==halfmoon.getPreferredMode()||"dark-mode"!=halfmoon.getPreferredMode()&&"not-set"!=halfmoon.getPreferredMode()||halfmoon.toggleDarkMode()</script>      <script>

      </script>
    </header>
</body>
<footer>
  <script src="/js/prism.js"></script>
<p>&copy; 2020-<?php echo date("Y"); ?>, <?php echo $ini['brand_name']; ?>. All rights reserved.</p>
  <?php 
  // Change view counter
   $db["pastes"][$_REQUEST['id']]["views"] == $db["pastes"][$_REQUEST['id']]["views"] += 1;
  $encodejson = json_encode($db);

$fileobj = fopen("database.json", 'w');
fwrite($fileobj,$encodejson);
fclose($fileobj);
  ?>
</footer>
</html>