<!DOCTYPE html>
<html>
<head>
<title>つぶやき</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8" />
</head>
<body>
<form method="post" action="/tweet.php">
<div class="tweet-box condensed">
<div class="tweet-box-title">
<h2>いまどうしてる？</h2>
</div>
 <div class="text-area">
  <div class="text-area-editor twttr-editor">
  <textarea class="twitter-anywhere-tweet-box-editor" name="status" style="width: 482px; height: 36px;"></textarea>
  </div>
  </div>
 </div>
<input type="submit" value="つぶやく">
</form>
<?php
echo "Hello, World!!";
?>
</body>
</html>