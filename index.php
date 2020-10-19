<?php 
$ini = parse_ini_file('config.ini');
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
  <!-- Do metatags -->
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
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">

<!-- Add main CSS files -->
  <link rel="stylesheet" href="/css/halfmoon.css">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/prism.css">
<!-- Do Recaptcha spam prevention -->
<?php
if ($ini['visibility'] == "public"){
echo '<script src="https://www.google.com/recaptcha/api.js?render=' . $ini['recaptcha_public'] . '"></script>';
}
?>
<head>
</head>

<body onload="updatePreview();" data-set-preferred-mode-onload="true">
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
                <a class="hyperlink" href="javascript:previewToggle();" id="togglebtn">Editor</a>&nbsp;&nbsp;&nbsp;
                    <a class="hyperlink"  href="javascript:this.disabled = true;this.innerText = 'Saving...';createPaste();" id="savebtn">Save!</a>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="button" onclick="halfmoon.toggleDarkMode();">🌙</button>
              </div>
                <!-- Navbar content (with the dropdown menu) -->
                <div class="navbar-content d-md-none ml-auto">
                    <!-- d-md-none = display: none on medium screens and up (width > 768px), ml-auto = margin-left: auto -->
                    
                </div>
            </nav>
          
<form method="POST" action="/api" id="pasteForm">
 
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <div id="gcaptcha_form"></div>
    <br><br>
    <textarea class="form-control col-sm shadow" style="outline:none;resize:none;border:none;" id="editor" oninput="updatePreview();" name="paste" id="paste" rows="25"></textarea>
    <div class="col-sm shadow" id="preview" style="padding-left:15px;padding-right:15px;word-break:break-all;white-space:normal;display:none;"></div>
</form>
            </div>
        </div>

        <!-- Requires halfmoon.js for the dropdowns -->
          <!-- Add main JS files -->
  <script src="/js/halfmoon.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/marked.js"></script>
      <script src="/js/xss.js"></script>
<script type="text/javascript">"not-set"==halfmoon.getPreferredMode()&&halfmoon.toggleDarkMode();</script>
    </header>
</body>
<footer>
  <script>
        function updatePreview(){
        document.getElementById('preview').innerHTML = marked(filterXSS(document.getElementById('editor').value));
      }
function previewToggle() {
  var editorid = document.getElementById("editor");
  var previewid = document.getElementById("preview");
  if (editorid.style.display === "none") {
    editorid.style.display = "block";
    previewid.style.display = "none";
    document.getElementById("togglebtn").innerHTML = "Editor";
  } else {
    editorid.style.display = "none";
    previewid.style.display = "block";
  document.getElementById("togglebtn").innerHTML = "Preview";

  }
}

 function createPaste(){
  grecaptcha.ready(function() {
       grecaptcha.execute('<?php echo $ini['recaptcha_public']; ?>', {action: 'sumbit'}).then(function(token) {
         document.getElementById("gcaptcha_form").innerHTML = '<input type="hidden" name="token" value="' + token + '">';
         document.getElementById('pasteForm').submit();

            });
        });
 }
  </script>
  
  <script src="/js/prism.js"></script>
</footer>
</html>