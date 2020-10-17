<?php require __DIR__ . '/vendor/autoload.php'; 
$ini = parse_ini_file('config.ini');
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once( 'includes/header.php'); ?>
</head>

<body>
    <header>
        <link rel="stylesheet" href="/css/halfmoon.css">
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
                    <li class="nav-item active">
                        <a href="#" class="nav-link">Docs</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Products</a>
                    </li>
                  
                </ul>
                <!-- Navbar form (inline form) -->
              <div class="navbar-content ml-auto">
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
                                <form action="..." method="...">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email address" required="required">
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Sign up</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content wrapper -->
            <div class="content-wrapper">
                ...
            </div>
        </div>

        <!-- Requires halfmoon.js for the dropdowns -->
        <script src="/js/halfmoon.js"></script>
    </header>
</body>
<footer>
    <?php include_once( 'includes/footer.php'); ?>
</footer>

</html>