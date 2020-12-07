<?php
//撰寫新增消費發票的程式碼
//將發票的號碼及相關資訊寫入資料庫

include_once "../base.php";
$_SESSION['error']=[];

// foreach ($_POST as $key => $value) {
//     $tmp[]=$key;
// }

// foreach($_POST as $key => $value){
//     $tmp2[]=$value;
// }

// echo "</pre>";
// print_r($tmp);
// echo "</pre>";

// implode：把陣列內的值換成字串，用"，"串起來
// echo "insert into invoices (`".implode("`,`",$tmp)."`)";
// echo "values('".implode("','",$tmp2)."')";


// 以下為簡化寫法

echo "<pre>";
print_r(array_keys($_POST));
echo "<pre>";

accept('number','發票號碼的欄位必填');
length('number',8,8,'長度錯誤');

//回到上一層用".."  
if(empty($_SESSION['error'])){
    save("invoices",$_POST);
    header("location:../index.php?do=invoice_list");
} else{
    header("location:../index.php");
}
    

// $sql="insert into invoices (`".implode("`,`",array_keys($_POST))."`) values('".implode("','",$_POST)."')";
// echo $sql;
// $pdo->exec($sql); execute執行
// select 用pdo query



function accept($field,$msg='此欄位不得為空'){
    if(empty($_POST[$field])){
        $_SESSION['error'][$field]['empty']=$msg;
    }
}

function length($field,$min,$max,$msg="長度不足"){
    if(strlen($_POST[$field])>$max || strlen($_POST[$field]) < $min){
        $_SESSION['error'][$field]['len']=$msg;
    }

}
