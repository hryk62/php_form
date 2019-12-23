<?php
//全てのカテゴリstart
function TabInAll($template_table){
    foreach($template_table as $tempAll){
        if($_SESSION['pochi_acc']==$tempAll['user_id']){
?>    
        <h4>テンプレート</h4>
        <form name="copyform" action="" method="post" >
        <?php
        print
        '<input type="hidden" name="id" value="'.$tempAll['id'].'">
        <textarea class="textarea" name="text" value="'.$tempAll['temp'].'" cols=100 rows=6 id="'.$tempAll['id'].'">'.
        $tempAll['temp'];
        ?>
    </textarea>
    <br>
<input type="submit" value="保存" class="button">
<?php 
        print'<input type="button" value="コピー" class="button" onclick="textcopy('.$tempAll['id'].')">';

        print'</form>';
        }
    }
}
//全てのカテゴリend


//各カテゴリstart
function AllSortsTab($tabnum,$template_table,$TabTable){
    foreach($template_table as $tempAll) {
        if($_SESSION['pochi_acc']==$tempAll['user_id'] && $tempAll['tab_id']==$tabnum){
?>
<h4>テンプレート</h4>
    <form name="copyform" action="" method="post" >
    <?php
        print
        '<input type="hidden" name="id" value="'.$tempAll['id'].'">
        <textarea class="textarea" name="text" value="'.$tempAll['temp'].'" cols=100 rows=6 id="C'.$tempAll['id'].'">'.
        $tempAll['temp'];
    ?>
</textarea>
<br>
<input type="submit" value="保存" class="button"><i class="fa fa-caret-right"></i></input>
    <?php
        print'<input type="button" value="コピー" class="button" onclick="textcopy(\'C'.$tempAll['id'].'\')">'; 
    ?>
    <i class="fa fa-caret-right"></i></input>

<select class="select" name="sort_tab_id" ><!--tabの追加文のタブ名をつけるstart-->
<?php
            foreach($TabTable as $AllSorts_Tab ){
                $selected = $AllSorts_Tab['tab_id'] == $tabnum ? "selected" : "";
                print '<option value="'.$AllSorts_Tab['tab_id'].'" '.$selected.'>'.$AllSorts_Tab['tab'].'</option>';
            }
?>
</select><!--tabの名前を追加end-->
</form>
<?php
        }
    }
}//function
//各カテゴリend
?>

<!------------------------------------------------------------------------------------------------>
<?php
function addtab($TabTable,$account,$user_max_tab){ ?><!--追加するカテゴリ-->
<h4><font color="#b22222">テンプレート/追加</font></h4>
<form name="addform" action="" method="post">
<textarea class="addtextarea" name="add_text" value="" cols=100 rows=6 placeholder='新しい定型文を入力してください。'>
</textarea>
<br>
<select class="select" name="add_tab_id" ><!--tabの追加文のタブ名をつけるstart-->
<?php
foreach($TabTable as $add_Tab){
    print '<option action="" maxlength="20" value="'.$add_Tab['tab_id'].'" >'.$add_Tab['tab'].'</option>';
    print $add_Tab['tab_id'];
}
?>
</select><!--tabの名前を追加end-->

<input type="submit" value="テンプレート追加" class="button">
<?php 
print'<input type="hidden" name="user_id" value="'.$_SESSION['pochi_acc'].'">';
?>
</form>
<?php } ?><!--定型文--追加--end-->

<!----------------------------------------------------------------------------------------------------------------------->

<?php
function alter_tab($TabTable){ ?>
<br>
<h4><font color="#b22222">タブ名 変更 10字以内</font></h4>
<?php 
$i=1;
foreach($TabTable as $alter_Tab){ ?>
    <form action="" method="post" class="form">
<?php
    print '<input type=""text" action="" name="alt_tab_name" maxlength="10" value="'.$alter_Tab['tab'].'" id="form" ></input>';
    print '<input type="hidden" name="alt_tab_id" value="'.$alter_Tab['tab_id'].'"></input>';
    ?>
    <input type="submit" value="変更" class="button">
    <br>
    </form>
<?php
    }
?>
<br>

<?php
} 

function new_tab($TabTable){ ?>
<form action="" method="post">
<h4><font color="#b22222">タブ新規追加 10字以内 作成限度5まで</font></h4>
<input type="text" name="new_tab" value="" maxlength="10" id="form"></input>
<input type="submit" value="タブ新規" class="button">
<br>
</form>
<?php
}
?>
