<?php
include_once "base.php";

$period_str=[
    1=>'1,2月',
    2=>'3,4月',
    3=>'5,6月',
    4=>'7,8月',
    5=>'9,10月',
    6=>'11,12月'
];

echo "你要對的發票是".$_GET['year']."年";
echo $period_str[$_GET['period']]."的發票";

//撈出該期的發票
$sql="select * from invoices where substr(`date`,1,4)='{$_GET['year']}'  && `period`='{$_GET['period']}' order by date desc";
$invoices=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// 找出年份的其他方法
// left(`date`,4)='{$_GET['year']}' 
//PDO取物件;兩個冒號::搜尋


//撈出該期的開獎獎號
$sql=" select * from award_numbers where `year`='{$_GET['year']}' && `period`='{$_GET['period']}'";
$award_numbers=$pdo->query($sql)->fetchAll(PDO::FETCH_NUM);


//開始對獎


?>