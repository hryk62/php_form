<?php
session_start();
session_destroy();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" href="template.css">
<title>LOGOUT</title>
</head>
<body>
<div class="wrapper">
<header>
<div class="logo">
<p>POCHI COPY</p>
</div>
</header>
<form action="http://localhost/php.rensyuu/template_tab/login_tab.php">
<p>ログアウトしました。　ご利用ありがとうございました。</p>
<input type="submit" value="ログイン画面へ">
<footer style="position: absolute;
    bottom: 0;"><p>(c)pochi copy</p></footer>
</body>
</html>