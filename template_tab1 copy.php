<?php
session_start();

$text=$_POST['text'];//変更定型文を代入
$text = htmlspecialchars($text);
$id=$_POST['id'];//変更template/idを代入
print $sort_tab_id=$_POST['sort_tab_id'];//変更tabID

$add_text=$_POST['add_text'];//新規定型文を代入
$user_id=$_POST['user_id'];//新規user_idを代入
$add_tab_id=$_POST['add_tab_id'];//新規tab_idを代入
print $add_tab_id;

print $alt_tab_name=$_POST['alt_tab_name'];//tabの名前変更
print $alt_tab_id=$_POST['alt_tab_id'];//tab_id

$new_tab=$_POST['new_tab'];

require_once 'template_DB.php';
//session_regenerate_id(true);

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
<title>POCHI</title>
</head>
<body>

<header>
<div class="logo">
<p>POCHI COPY</p>
</div>

<div>
<form action="http://localhost/php.rensyuu/template_tab/logout.php">
<input type="submit" value="ログアウト" class="logout">
</form>
</div>

</header>

<br>
<p id="tabcontrol">
    <a href="#tabpage0">全てのカテゴリ</a>
    <?php
    //tabの中身を表示start
    foreach($TabTable as $tab_DB){
        print '<a href="#tabpage'.$tab_DB['tab_id'].'">'.$tab_DB['tab'].'</a>';
    }
    //タブの中身を表示end
    ?>
    <a href="#tabpage01">ユーザー設定</a>
</p>
<!--start-->
<?php
try{
    if(!isset($_SESSION['pochi_acc'])){
        print'<h1><font color="red">ユーザーIDとパスワードの間違っており、ログインされていません。<br></font></h1>';
        exit();
    }
?>
<div id="tabbody"><!-------------tabbody start------------------->

<div id="tabpage0"><!---------------すべてのカテゴリ Start--------->
    <?php
    require 'copy_save.php';
    TabInAll($template_table);
    ?>
</div><!--すべてのカテゴリ--End-->


<!--定型文コピー＆保存start---各カテゴリ-->
<?php
for($tabnum=1;$tabnum<=$user_max_tab['maxtab'];$tabnum++){
    print '<div id="tabpage'.$tabnum.'">';
    AllSortsTab($tabnum,$template_table,$TabTable);
    
    print'</div>';
}
?>
<!--定型文コピー＆保存end---各カテゴリ-->


<!--定型文コピー＆保存start---追加変更-->
<div id="tabpage01">
<?php 
addtab($TabTable,$account,$user_max_tab);//追加
alter_tab($TabTable);//タブ名変更new_tab
new_tab($TabTable);
?>
</div><!--定型文コピー＆保存end--追加変更-->

</div><!-------------tab-body-------------->

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
$address.'<br>ログインパス:'.$pass.'<br>ログイン登録ID:'.$account['id'].
'<br><br>新規定型文tabID:'.$add_tab_id.'<br>新規定型文:'.$add_text.'<br>';

//表示テストend
?>

<footer><p>(c)pochi copy</p></footer>
</body>
</html>