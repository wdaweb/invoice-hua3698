<?php
//撰寫新增消費發票的程式碼
//將發票的號碼及相關資訊寫入資料庫

include_once "../base.php";
$_SESSION['err']=[];

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
length('number',8,8,'長度不足');

save("invoices",$_POST);
// $sql="insert into invoices (`".implode("`,`",array_keys($_POST))."`) values('".implode("','",$_POST)."')";
// echo $sql;
// $pdo->exec($sql); execute執行
// select 用pdo query

//回到上一層用".."
if(empty($_SESSION['err'])){
    $pdo->exec($sql);
    header("location:../index.php?do=invoice_list");
}else{
    header("location:../index.php");
}

?>