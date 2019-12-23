<?php
//sql接続文start
$dsn='mysql:dbname=template_data;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO ($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//sql接続文end

if(isset($_POST['loginAddress'])){//ログイン画面の情報がある場合代入を行う
    $address=$_POST['loginAddress'];//ログインユーザーID
    $pass=$_POST['loginPass'];///ログインパスワード
}

$sql='SELECT * FROM template';
$stmt=$dbh->prepare($sql);
$stmt->execute();             
$template_table=$stmt->fetchAll(PDO::FETCH_ASSOC);

$sql='SELECT * FROM user';
$stmt=$dbh->prepare($sql);
$stmt->execute();             
$users=$stmt->fetchAll(PDO::FETCH_ASSOC);


if(isset($entryAddress)){
    $sql='SELECT * FROM user WHERE address=?';
    $stmt=$dbh->prepare($sql);
    $check[]=$entryAddress;
    $stmt->execute($check);             
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
}

//ログインのIdとpassのデータのユーザーを取り出す
$sql='SELECT * FROM user WHERE address=? AND pass=?';
$stmt=$dbh->prepare($sql);
$accounts[]=$address;
$accounts[]=$pass;
$stmt->execute($accounts);            
$account=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($account['id'])){
    $_SESSION['pochi_id']=$address;
    $_SESSION['pochi_pass']=$pass;
    print $_SESSION['pochi_acc']=$account['id'];
}

    
if(isset($add_text)){//定型文を追加するDB
    $sql='INSERT template(temp,user_id,tab_id)VALUES(?,?,?)';
    $stmt=$dbh->prepare($sql);
    $addTo[]=$add_text;
    $addTo[]=$_SESSION['pochi_acc'];
    $addTo[]=$add_tab_id;
    $stmt->execute($addTo);             
    $add_alert = "<script type='text/javascript'>alert('定型文を追加しました。');</script>";
    print $add_alert;
    $add_text=null;
    $add_tab_id=null;
}

if(isset($alt_tab_name)){
    $sql='UPDATE tab SET tab=? WHERE tab_id=? AND user_id=?';
    $stmt=$dbh->prepare($sql);
    $alts_tab[]=$alt_tab_name;
    $alts_tab[]=$alt_tab_id;
    $alts_tab[]=$_SESSION['pochi_acc'];
    $stmt->execute($alts_tab);             
    $alt_tab_name=null;
    $alt_tab_id=null;
    $alt_tab_alert = "<script type='text/javascript'>alert('タブ名を変更しました。');</script>";
    print $alt_tab_alert;
}


if($text!=null){//既存の定型文を更新/非更新
    //if($text!=$template_table[$id-1]['temp']){
        $sql='UPDATE template SET temp=?,tab_id=? WHERE id=?';
        $stmt=$dbh->prepare($sql);
        $templ[]=$text;
        $templ[]=$sort_tab_id;
        $templ[]=$id;
        $stmt->execute($templ);             
        $text=null;
        $text_alert1 = "<script type='text/javascript'>alert('定型文を更新しました。');</script>";
        print $text_alert1;
    // }else{
    //     $text=null;
    //     $text_alert2="<script type='text/javascript'>alert('既存の定型文と一致するため更新はしない');</script>";
    //     print $text_alert2;
    // }
}
$sql='SELECT * FROM template ORDER BY tab_id ASC';
$stmt=$dbh->prepare($sql);
$stmt->execute();          
$template_table=$stmt->fetchAll(PDO::FETCH_ASSOC);


$sql='SELECT MAX(tab_id) AS maxtab FROM tab WHERE user_id=?';
$stmt=$dbh->prepare($sql);
$group1[]=$_SESSION['pochi_acc'];
$stmt->execute($group1);
$user_max_tab=$stmt->fetch(PDO::FETCH_ASSOC);

//ユーザーtabを取り出す
$sql='SELECT * FROM tab WHERE user_id=?';
$stmt=$dbh->prepare($sql);
$userTabTables[]=$_SESSION['pochi_acc'];
$stmt->execute($userTabTables);            
$TabTable=$stmt->fetchAll(PDO::FETCH_ASSOC);

//tabを新規作成

if(isset($new_tab)){
    if(!($user_max_tab['maxtab']>=5)){
        
        if($user_max_tab['maxtab']==null){
            $new_tab_id_add=1;
        }elseif(isset($user_max_tab['maxtab'])){
            $new_tab_id_add=$user_max_tab['maxtab']+1;
        }
        // $new_tab_id_add=$user_max_tab['maxtab']==null ? 1 : $user_max_tab['maxtab']+1;
        $sql='INSERT tab(tab_id,tab,user_id)VALUES(?,?,?)';
        $stmt=$dbh->prepare($sql);
        $new_tab_tables[]=$new_tab_id_add;
        $new_tab_tables[]=$new_tab;//新タブ
        $new_tab_tables[]=$_SESSION['pochi_acc'];//ログインユーザーのID
        
        $stmt->execute($new_tab_tables);             
        $new_alert = "<script type='text/javascript'>alert('タブを新規作成しました。');</script>";

        print $new_alert;
        $new_tab=null;
        $add_tab_id=null; 

        $sql='SELECT MAX(tab_id) AS maxtab FROM tab WHERE user_id=?';
        $stmt=$dbh->prepare($sql);
        $group2[]=$_SESSION['pochi_acc'];
        $stmt->execute($group2);
        $user_max_tab=$stmt->fetch(PDO::FETCH_ASSOC);

        //ユーザーtabを取り出す
        $sql='SELECT * FROM tab WHERE user_id=?';
        $stmt=$dbh->prepare($sql);
        $userTabTables2[]=$_SESSION['pochi_acc'];
        $stmt->execute($userTabTables2);            
        $TabTable=$stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $new_NG_alert = "<script type='text/javascript'>alert('タブの作成限度になっており作成できません。');</script>";
        print $new_NG_alert;
    }
}


?>



