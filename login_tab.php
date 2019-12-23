<?php

$entryAddress=$_POST['entryAddress'];
$entryPass=$_POST['entryPass'];
require_once('template_DB.php');
session_start();
if(isset($entryAddress,$entryPass)){
    if($user==null){
        $sql='INSERT user(address,pass)VALUES(?,?)';
        $stmt=$dbh->prepare($sql);
        $entry[]=$entryAddress;
        $entry[]=$entryPass;
        $stmt->execute($entry);
        $entryAddress=null;
        $entryPass=null;
        $test_alert1 = "<script type='text/javascript'>alert('ユーザー登録が完了しました。');</script>";
        print $test_alert1;
    }else{
        $entryAddress=null;
        $entryPass=null;
        $test_alert2="<script type='text/javascript'>alert('登録済みのユーザーです。');</script>";
        print $test_alert2;
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" href="template.css">
<title>POCHI LOGIN</title>
</head>
<body>
<div class="wrapper">
<header>
<div class="logo">
<p>POCHI COPY</p>
</div>
</header>

<div class="Login" style="padding: 10px; margin-bottom: 10px; border: 1px dotted #333333;">
<p>ログインフォーム</p>

<form action="http://localhost/php.rensyuu/template_tab/template_tab1 copy.php" method="post">
<p>ユーザーID（半角英数字6字以上/20字以内）</p>
    
<input type="text" name="loginAddress" value="" id="form" size="30" pattern="^[0-9a-z]+$" placeholder='ユーザーIDを入力してください' required >
<p>パスワード(半角数字4文字)</p>

<input type="text" name="loginPass" value="1111" id="form" size="30" maxlength="4" minlength="4" pattern="^[0-9]+$" placeholder='パスワードを入力してください' required>
<input type="submit" value="ログイン" class="button"></input>
</form>
</div>

<div class="entry" style="padding: 10px; margin-bottom: 10px; border: 1px dotted #333333;">
<p>登録フォーム</p>
<form action="" method="post">
<p>ユーザーID（半角英数字4字以上/20字以内）</p>  
<input type="text" name="entryAddress" value="" id="form" size="30" maxlength="20" minlength="4" pattern="^[0-9a-z]+$"　 placeholder='ユーザーIDを入力してください' required>
<p>パスワード（半角数字4文字） </p>
<input type="text" name="entryPass" value="" id="form" size="30" maxlength="4" minlength="4"  pattern="^[0-9]+$" placeholder='パスワードを入力してください' required>
<input type="submit" value="登録" class="button" >
</form>
</div>
    <?php
    foreach($users as $menber){
        print '<div style="padding: 10px; margin-bottom: 10px; border: 1px dotted #333333;">';
        print '<font color="blue">登録ユーザー<br>';
        print 'ID : '.$menber['id'].'<br>';
        print 'ユーザーID : '.$menber['address'].'<br>';
        print 'パスワード : '.$menber['pass'].'</font>';
        print '</div>';
    }  
    ?>
    

</div>
<footer><p>(c)pochi copy</p></footer>
</body>
</html>