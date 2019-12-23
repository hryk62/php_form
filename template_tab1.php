<?php
session_start();
$text=$_POST['text'];//変更定型文を代入
$text = htmlspecialchars($text);
$id=$_POST['id'];//変更template/idを代入 
$add=$_POST['add'];//新規定型文を代入
$user_id=$_POST['user_id'];//新規user_idを代入

if(isset($_POST['loginAddress'])){//ログイン画面の情報がある場合代入を行う
$address=$_POST['loginAddress'];//ログインユーザーID
$pass=$_POST['loginPass'];///ログインパスワード
}
require_once 'template_DB.php';
//session_regenerate_id(true); 

//タブ中身を代入する
foreach($data as $data1){
    if($data1['user_id']==$_SESSION['pochi_acc']){
        if(!isset($tab1,$tab2,$tab3,$tab4,$tab5)){          
            switch($data1['num']){
                case'1':
                    //print $data1['tab'];
                    $tab1=$data1['tab'];
                    break;
                case'2':
                    //print $data1['tab'];
                    $tab2=$data1['tab'];
                    break;
                case'3':
                    //print $data1['tab'];
                    $tab3=$data1['tab'];
                    break;
                case'4':
                    //print $data1['tab'];
                    $tab4=$data1['tab'];
                    break;
                case'5':
                    //print $data1['tab'];
                    $tab5=$data1['tab'];
                    break;
            }//switch
        }//if
    }//if
}//foreach
//タブの中身代入end

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" href="template.css"><!--設定など-->
<link rel="stylesheet" href="js_test.css"><!--TABの表示など-->
<?php
require 'copy_save.php';
?>
<script></script>
<title>POCHI</title>
</head>
<body>
<header>
<b><p>POCHI COPY</p></b>
</header>
<form action="http://localhost/php.rensyuu/logout.php">
<input type="submit" value="ログアウト" class="out">
</form>
<br>
<p id="tabcontrol">
    <a href="#tabpage1">全てのカテゴリ</a>
    <!--//カテゴリA----start -->
    <a href="#tabpage2">1
        <?php
        print $tab1;
        ?>
    </a>
    <!--//カテゴリA----end -->
    <!--//カテゴリB----start -->
    <a href="#tabpage3">2
        <?php
        print $tab2;
        ?>
    </a>
    <!--//カテゴリB----end-->
    <!--//カテゴリC----start -->
    <a href="#tabpage4">3
        <?php   
        print $tab3;
        ?>
    </a>
    <!--//カテゴリC----end-->
    <!--//カテゴリD----start -->
    <a href="#tabpage5">4
        <?php
        print $tab4;
        ?>
    </a>
    <!--//カテゴリD----end-->
    <!--//カテゴリE----start -->
    <a href="#tabpage6">5
        <?php
        print $tab5;
        ?>
    </a>
    <!--//カテゴリE----end-->
    <a href="#tabpage7">ユーザー設定</a>
</p>
<!--start-->
<?php
try{
    if(!isset($_SESSION['pochi_acc'])){
        print'<h1><font color="red">ログインされていません。<br></font></h1>';
        exit();
    }
?>
<div id="tabbody"><!-------------tabbody start------------------->
    <div id="tabpage1"><!---------------すべてのカテゴリ Start--------------->
<?php
    foreach($data as $temp){
        if($_SESSION['pochi_acc']==$temp['user_id']){
?>    
        <h4>テンプレート</h4>
        <form name="copyform" action="" method="post" >
        <?php 
        print 
        '<input type="hidden" name="id" value="'.$temp['id'].'">
        <textarea class="textarea" name="text" value="'.$temp['temp'].'" cols=100 rows=6 id="'.$temp['id'].'">'.
        $temp['temp'];      
        ?>
    </textarea>
    <br>
<input type="submit" value="保存" class="save">
<?php 
        print'<input type="button" value="コピー" class="copy" onclick="textcopy('.$temp['id'].')">';
        print'</form>';
        }//foreach
    }
?>
</div> <!--すべてのカテゴリ--End-->

<div id="tabpage2"><!--定型文コピー＆保存start---カテゴリA-->
<?php
    foreach($data as $temp){
        if($_SESSION['pochi_acc']==$temp['user_id'] && $temp['num']=="1"){
?>  
<h4>テンプレート</h4>
     <form name="copyform" action="" method="post" >
     <?php 
        print 
        '<input type="hidden" name="id" value="'.$temp['id'].'">
        <textarea class="textarea" name="text" value="'.$temp['temp'].'" cols=100 rows=6 id="A'.$temp['id'].'">'.
        $temp['temp'];      
    ?>
</textarea>
<br>
<input type="submit" value="保存" class="save">
    <?php 
        print'<input type="button" value="コピー" class="copy" onclick="textcopy(\'A'.$temp['id'].'\')">';
        print'</form>';
        }//foreach
    }
    ?>
</div><!--定型文コピー＆保存end---カテゴリA-->

<div id="tabpage3"><!--定型文コピー＆保存start---カテゴリB-->
<?php
    foreach($data as $temp){
        if($_SESSION['pochi_acc']==$temp['user_id'] && $temp['num']=="2"){
?>  
<h4>テンプレート</h4>
     <form name="copyform" action="" method="post" >
     <?php 
        print 
        '<input type="hidden" name="id" value="'.$temp['id'].'">
        <textarea class="textarea" name="text" value="'.$temp['temp'].'" cols=100 rows=6 id="B'.$temp['id'].'">'.
        $temp['temp'];      
    ?>
</textarea>
<br>
<input type="submit" value="保存" class="save">
    <?php 
        print'<input type="button" value="コピー" class="copy" onclick="textcopy(\'B'.$temp['id'].'\')">';
        print'</form>';
        }//foreach
    }
    ?>
</div><!--定型文コピー＆保存end---カテゴリB-->

<div id="tabpage4"><!--定型文コピー＆保存start---カテゴリC-->
<?php
    foreach($data as $temp){
        if($_SESSION['pochi_acc']==$temp['user_id'] && $temp['num']=="3"){
?>
<h4>テンプレート</h4>
     <form name="copyform" action="" method="post" >
     <?php 
        print 
        '<input type="hidden" name="id" value="'.$temp['id'].'">
        <textarea class="textarea" name="text" value="'.$temp['temp'].'" cols=100 rows=6 id="C'.$temp['id'].'">'.
        $temp['temp'];      
    ?>
</textarea>
<br>
<input type="submit" value="保存" class="save">
    <?php 
        print'<input type="button" value="コピー" class="copy" onclick="textcopy(\'C'.$temp['id'].'\')">';
        print'</form>';
        }//foreach
    }
    ?>
</div><!--定型文コピー＆保存end---カテゴリC-->

<div id="tabpage5"><!--定型文コピー＆保存start---カテゴリD-->
<?php
    foreach($data as $temp){
        if($_SESSION['pochi_acc']==$temp['user_id'] && $temp['num']=="4"){
?>  
<h4>テンプレート</h4>
     <form name="copyform" action="" method="post" >
     <?php 
        print 
        '<input type="hidden" name="id" value="'.$temp['id'].'">
        <textarea class="textarea" name="text" value="'.$temp['temp'].'" cols=100 rows=6 id="D'.$temp['id'].'">'.
        $temp['temp'];      
    ?>
</textarea>
<br>
<input type="submit" value="保存" class="save">
    <?php 
        print'<input type="button" value="コピー" class="copy" onclick="textcopy(\'D'.$temp['id'].'\')">';
        print'</form>';
        }//foreach
    }
    ?>
</div><!--定型文コピー＆保存end---カテゴリD-->

<div id="tabpage6"><!--定型文コピー＆保存start---カテゴリE-->
<?php
    foreach($data as $temp){
        if($_SESSION['pochi_acc']==$temp['user_id'] && $temp['num']=="5"){
?>  
<h4>テンプレート</h4>
     <form name="copyform" action="" method="post" >
     <?php
        print 
        '<input type="hidden" name="id" value="'.$temp['id'].'">
        <textarea class="textarea" name="text" value="'.$temp['temp'].'" cols=100 rows=6 id="E'.$temp['id'].'">'.
        $temp['temp'];
    ?>
</textarea>
<br>
<input type="submit" value="保存" class="save">
    <?php 
        print'<input type="button" value="コピー" class="copy" onclick="textcopy(\'E'.$temp['id'].'\')">';
        print'</form>';
        }//foreach
    }//if
    ?>
</div>

<!--定型文コピー＆保存start---追加変更-->
<div id="tabpage7">

<!--定型文--追加--start-->
<h4><font color="#b22222">定型文追加</font></h4>
<?php
var_dump($group["maxtab"]);
var_dump($group);
?>
<form name="addform" action="" method="post">
<input type="submit" value="追加" class="add"add" valu>
<!--追加するカテゴリ-->
<select class="addselect"name="" id="">
<?php
for($i=1;$i<=($group['maxtab']);$i++){
    foreach($account as $addtab){
    print'<option value="">'.$i.''.'</option>';
    }
}
?>
</select>
<!--追加するカテゴリend-->
    <textarea class="addtextarea" name="add" value="" cols=100 rows=6 placeholder='新しい定型文を入力してください。'>
    </textarea><br>
    <?php print'<input type="hidden" name="user_id" value="'.$_SESSION['pochi_acc'].'">';?>

</form><!--定型文--追加--end-->
</div><!--定型文コピー＆保存end--追加変更-->
</div><!-----------------------------------tab-body--------------------------------------->

<script>
    function textcopy(copy) {
        console.log(copy);
        let cp = document.getElementById(copy);
        cp.select();
        document.execCommand("copy");
    }
</script>
<?php
}//try--end
catch(Exception $e){
    print 'ERROR';
}//catch--end
$dbh=null;
?>
<script type="text/javascript">
// ---------------------------
// ▼A：対象要素を得る
// ---------------------------
let tabs = document.getElementById('tabcontrol').getElementsByTagName('a');
let pages = document.getElementById('tabbody').getElementsByTagName('div');

// ---------------------------
// ▼B：タブの切り替え処理
// ---------------------------
function changeTab() {
   // ▼B-1. href属性値から対象のid名を抜き出す
   let targetid = this.href.substring(this.href.indexOf('#')+1,this.href.length);

   // ▼B-2. 指定のタブページだけを表示する
   for(let i=0; i<pages.length; i++) {
      if( pages[i].id != targetid ) {
         pages[i].style.display = "none";
      }
      else {
         pages[i].style.display = "block";
      }
   }

   // ▼B-3. クリックされたタブを前面に表示する
   for(let i=0; i<tabs.length; i++) {
      tabs[i].style.zIndex = "0";
   }
   this.style.zIndex = "10";

   // ▼B-4. ページ遷移しないようにfalseを返す
   return false;
}

// ---------------------------
// ▼C：すべてのタブに対して、クリック時にchangeTab関数が実行されるよう指定する
// ---------------------------
for(let i=0; i<tabs.length; i++) {
   tabs[i].onclick = changeTab;
}

// ---------------------------
// ▼D：最初は先頭のタブを選択しておく
// ---------------------------
tabs[0].onclick();
</script>
<?php
//表示テストstart
print'<br>ログイン後session_ID値:'.$_SESSION['pochi_acc'].'<br>ログインアドレス:'.
$address.'<br>ログインパス:'.$pass.'<br>ログイン登録ID:'.$account['id'].'<br><br>';
print 'カテゴリ内容'.$tab1.','.$tab2.','.$tab3.','.$tab4.','.$tab5.'が代入しています<br><br>';
//表示テストend


?>

<footer><p>(c)pochi copy</p></footer>
</body>
</html>