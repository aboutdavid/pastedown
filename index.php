<?php 
require __DIR__ . '/vendor/autoload.php'; 
$ini = parse_ini_file('config.ini');
$file = file_get_contents("database.json");
$db = json_decode($file, true);
?>
<!DOCTYPE html>
<html>
  <!-- Do metatags -->
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<!-- Add main CSS files -->
  <link rel="stylesheet" href="/css/halfmoon.css">
  <link rel="stylesheet" href="/css/main.css">

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
                <a href="" class="navbar-brand">
                    <img src="https://cdn.glitch.com/65fb0f88-4115-49b0-bcb6-88908e25d1db%2Fnotepad.svg?v=1602954032741" alt="Icon" onerror="this.style.display='none'"><?php echo $ini['brand_name']; ?>
                </a>
                <!-- Navbar nav -->
                <ul class="navbar-nav d-none d-md-flex">
                    <!-- d-none = display: none, d-md-flex = display: flex on medium screens and up (width > 768px) -->
    
                  
                </ul>
                <!-- Navbar form (inline form) -->
              <div class="navbar-content ml-auto">
                    <button class="btn btn-primary" type="button" onclick="this.disabled = true;this.innerText = 'Saving...';document.getElementById('pasteForm').submit();" id="savebtn">Save!</button>&nbsp;
                    <button class="btn btn-primary" type="button" onclick="halfmoon.toggleDarkMode();">🌙</button>
              </div>
                <!-- Navbar content (with the dropdown menu) -->
                <div class="navbar-content d-md-none ml-auto">
                    <!-- d-md-none = display: none on medium screens and up (width > 768px), ml-auto = margin-left: auto -->
                    
                </div>
            </nav>
<form method="POST" action="/api.php" id="pasteForm">
  
          
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <div class="container-fluid">
  <div class="row">
    <textarea class="form-control col-sm shadow" placeholder="Normal textarea for multi-line input" style="outline:none;resize:none;border:none;height:90vh;" id="editor" oninput="updatePreview();" name="paste"></textarea>
    <div class="col-sm shadow" id="preview" style="padding-left:15px;padding-right:15px;word-break:break-all;height:90vh;white-space:normal;"></div>
  </div>
</div>
</form>
            </div>
        </div>

        <!-- Requires halfmoon.js for the dropdowns -->
          <!-- Add main JS files -->
  <script src="/js/halfmoon.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/marked.js"></script>
      <script src="/js/xss.js"></script>
      <script src="/js/axios.js"></script>
    <script type="text/javascript">"light-mode"==halfmoon.getPreferredMode()||("dark-mode"==halfmoon.getPreferredMode()?halfmoon.toggleDarkMode():"not-set"==halfmoon.getPreferredMode()&&halfmoon.toggleDarkMode());</script>

    </header>
</body>
<footer>
  <script>
        function updatePreview(){
        document.getElementById('preview').innerHTML = filterXSS(marked(document.getElementById('editor').value));
      }
  </script>
<p>&copy; 2020-<?php echo date("Y"); ?>, <?php echo $ini['brand_name']; ?>. All rights reserved.</p>
</footer>
</html>