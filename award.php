<?php
//單一發票對獎
include_once "base.php";

$inv_id=$_GET['id'];

$invoice=$pdo->query("select * from invoices where id='$inv_id'")->fetch();
$number=$invoice['number'];

//找出獎號
/*
1.確認期數->發票日期做分析
2.得到期數的資料後，撈出該期的開獎獎號
*/

$date=$invoice['date'];
//explode('-',$date)取得日期資料的陣列，陣列的第二個元素就是月份
//就可以推算期數，有了期數及年份就可以找到開獎的號碼
//$array=explode('-',$date)
//$month=$array[1]
//$period=ceil(month/2)
$year=explode('-',$date);
$period=ceil(explode('-',$date)[1])/2;  /* 得到該月所屬期數 */

$awards=$pdo->query("select * from award_number where year='$year' && period='$period' ")->fetchAll();


?>