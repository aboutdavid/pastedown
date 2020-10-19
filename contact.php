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
<head>
  <link rel="stylesheet" href="https://s.pageclip.co/v1/pageclip.css" media="screen">
    <link rel="stylesheet" href="/css/halfmoon.css" media="screen">
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
</head>
<body>
  <form action="https://send.pageclip.co/1rqQVmbOXkLEmJ7RDAYgwMk3B7T1WI6J/Pastedown-Contact-Form" class="pageclip-form" method="post">
  <div class="w-400 mw-full" style="display:block;margin-left:auto;margin-right:auto;">
<div class="card">
    <h2 class="card-title">
      Contact me
    </h2>
  <!-- Name -->
  <div class="form-group">
    <label for="name" class="required">Name</label>
    <input type="text" class="form-control" id="name" placeholder="" required="required" name="name">
  </div>
  
<!-- Email -->
  <div class="form-group">
    <label for="email" class="required">Email</label>
    <input type="email" class="form-control" id="email" placeholder="" required="required" name="email">
  </div>


  <!-- Message -->
  <div class="form-group">
    <label for="description" class="required">Message</label>
    <textarea class="form-control" id="description" placeholder="" name="message" required="required"></textarea>
  </div>

  <!-- Submit button -->
  <input class="btn btn-primary pageclip-form__submit" type="submit" value="Submit">

</div>
</div>
</form>
  <footer>
    <script src="https://s.pageclip.co/v1/pageclip.js" charset="utf-8"></script>
    <script src="/js/halfmoon.js"></script>
  </footer>
</body>
