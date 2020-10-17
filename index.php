<?php require __DIR__ . '/vendor/autoload.php'; 
$ini = parse_ini_file('config.ini');
?>
<!DOCTYPE html>
<html>
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
                    <li class="nav-item active">
                        <a href="#" class="nav-link">Docs</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Products</a>
                    </li>
                  
                </ul>
                <!-- Navbar form (inline form) -->
              <div class="navbar-content ml-auto">
                    <button class="btn btn-primary" type="button" onclick="this.disabled = true;this.innerText = 'Saving...'">Save</button>&nbsp;
                    <button class="btn btn-primary" type="button" onclick="halfmoon.toggleDarkMode();">🌙</button>
              </div>
                <!-- Navbar content (with the dropdown menu) -->
                <div class="navbar-content d-md-none ml-auto">
                    <!-- d-md-none = display: none on medium screens and up (width > 768px), ml-auto = margin-left: auto -->
                    <div class="dropdown with-arrow">
                        <button class="btn" data-toggle="dropdown" type="button" id="navbar-dropdown-toggle-btn-1">
                            Menu
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right w-200" aria-labelledby="navbar-dropdown-toggle-btn-1">
                            <!-- w-200 = width: 20rem (200px) -->
                            <a href="#" class="dropdown-item">Docs</a>
                            <a href="#" class="dropdown-item">Products</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-content">
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <div class="container-fluid">
  <div class="row">
    <div class="col-sm shadow" style="resize:none;"><textarea class="form-control" placeholder="Normal textarea for multi-line input" style="outline:none;resize:none;border:none;height:80vh;" id="editor" oninput="updatePreview();"></textarea></div>
    <div class="col-sm shadow" id="preview" style="padding-left:15px;padding-right:15px;word-break:break-all;"></div>
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
    <script type="text/javascript">"light-mode"==halfmoon.getPreferredMode()||("dark-mode"==halfmoon.getPreferredMode()||"not-set"==halfmoon.getPreferredMode()&&{{ metadata.defaultDarkMode }})&&halfmoon.toggleDarkMode();</script>
      <script>
      function updatePreview(){
        document.getElementById('preview').innerHTML = filterXSS(marked(document.getElementById('editor').value));
      }
      function save(){
        let response = await fetch("/api.php");
        var res = response.text();
        location.replace("/")
      }
      </script>
    </header>
</body>
<footer>
<p>&copy; 2020-<?php echo date("Y"); ?>, <?php echo $ini['brand_name']; ?>. All rights reserved.</p>
</footer>
</html>