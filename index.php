<?php
require __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Require CSS -->
<link rel="stylesheet" src="/css/halfmoon.css">
    <!-- Require JS -->
  <script src="/js/halfmoon.js"></script>
</head>
<body>
<header>
              <nav class="navbar">
                <!-- Navbar content with toggle sidebar button -->
                <div class="navbar-content">

                </div>
                <!-- Icon/brand -->
                <a href="/" class="navbar-brand">
                    <img src="https://cdn.glitch.com/f648f832-1dab-41a0-a2ec-8e3be00e552b%2F1F680_color.png?v=1602371731988" alt="..." />Rocket11ty
                </a>
                <!-- Navbar buttons -->
                <ul class="navbar-nav d-none d-md-flex">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/posts" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="/feed/feed.xml" class="nav-link">RSS</a>
                    </li>
                </ul>
                <!-- Darkmode toggle -->
                <div class="navbar-content ml-auto">
                    <!-- ml-auto = margin-left: auto -->
                    <button class="btn btn-primary" type="button" onclick="halfmoon.toggleDarkMode();">🌙</button>
                </div>
            </nav>
</header>
</body>
</html>