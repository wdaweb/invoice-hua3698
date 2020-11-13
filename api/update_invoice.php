<?php

include_once "../base.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql="update 
        invoices
      set 
        `code`='{$_POST['code']}',
        `number`='{$_POST['number']}',
        `date`='{$_POST['date']}',
        `payment`='{$_POST['payment']}' 
     where 
        `id`='{$_POST['id']}'";

$pdo->exec($sql);
// 用exec不需要回傳資料
// 如需要回傳資料才用query
echo $sql;
header("location:../index.php?do=invoice_list");

?>