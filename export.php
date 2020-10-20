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
function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

ob_start("sanitize_output");
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
  <!-- Add main JS files -->
      <script src="https://cdn.jsdelivr.net/npm/web-streams-polyfill@2.0.2/dist/ponyfill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/streamsaver@2.0.3/StreamSaver.min.js"></script>
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
 <h3>Export as:</h3>
    <div class="btn-group" role="group" aria-label="Basic example" style="position:absolute;top:50%;right:50%;left:50%;bottom:50%;">
<button class="btn" type="button" onclick="download('/export/', '<?php echo $_REQUEST['id']; ?>.md')">Markdown</button>
      
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
      <script src="/js/axios.js"></script>
<script type="text/javascript">"light-mode"==halfmoon.getPreferredMode()||"dark-mode"!=halfmoon.getPreferredMode()&&"not-set"!=halfmoon.getPreferredMode()||halfmoon.toggleDarkMode()</script>  
    </header>
</body>
<footer>
  <script>
  async function download(url, saveas){
var response = await fetch(url);
var res = await response.text();
    const fileStream = streamSaver.createWriteStream(saveas, {
    size: 22, // (optional) Will show progress
    writableStrategy: undefined, // (optional)
    readableStrategy: undefined  // (optional)
  })

  new Response(res).body
    .pipeTo(fileStream)
    .then(success, error)
}
  </script>
  <script src="/js/prism.js"></script>
<p>&copy; 2020-<?php echo date("Y"); ?>, <?php echo $ini['brand_name']; ?>. All rights reserved.</p>
</footer>
</html>