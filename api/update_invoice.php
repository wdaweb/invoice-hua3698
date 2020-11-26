<?php

include_once "../base.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$row=find('invoices',$_POST['id']);

$row['code']=$_POST['code'];
$row['number']=$_POST['number'];
$row['date']=$_POST['date'];
$row['payment']=$_POST['payment'];

save('invoices',$row);

// $sql="update 
//         invoices
//       set 
//         `code`='{$_POST['code']}',
//         `number`='{$_POST['number']}',
//         `date`='{$_POST['date']}',
//         `payment`='{$_POST['payment']}' 
//      where 
//         `id`='{$_POST['id']}'";

//$pdo->exec($sql);
// 用exec不需要回傳資料
// 如需要回傳資料才用query

to("../index.php?do=invoice_list");
// header("location:../index.php?do=invoice_list");

?>