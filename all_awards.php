<?php
include_once "base.php";

$period_str = [
    1 => '1、2月',
    2 => '3、4月',
    3 => '5、6月',
    4 => '7、8月',
    5 => '9、10月',
    6 => '11、12月'
];

echo "你要對的發票是" . $_GET['year'] . "年";
echo $period_str[$_GET['period']] . "的發票";

//撈出該期的發票
$sql = "select * from invoices where substr(`date`,1,4)='{$_GET['year']}'  && `period`='{$_GET['period']}' order by date desc";
$invoices = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// 找出年份的其他方法
// left(`date`,4)='{$_GET['year']}' 
//PDO取物件;兩個冒號::搜尋


//撈出該期的開獎獎號
$sql = " select * from award_numbers where `year`='{$_GET['year']}' && `period`='{$_GET['period']}'";
$award_numbers = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);


//開始對獎
$all_result = -1;

foreach ($invoices as $inv) {

    //對獎程式
    $number = $inv['number'];
    $date = $inv['date'];
    $year = explode('-', $date)[0];
    $period = ceil(explode('-', $date)[1] / 2);

    foreach ($award_numbers as $award) {
        switch ($award['type']) {
            case 1:
                if ($award['number'] == $number) {
                    echo "<br>號碼=" . $number . "<br>";
                    echo "中了特別獎";
                    $all_result = 1;
                }
                break;
            case 2:
                if ($award['number'] == $number) {
                    echo "<br>號碼=" . $number . "<br>";
                    echo "中了特獎";
                    $all_result = 1;
                }
                break;
            case 3:
                $result = -1;
                for ($i = 5; $i >= 0; $i--) {
                    $target = mb_substr($award['number'], $i, 8 - $i, 'utf8');
                    $mynumber = mb_substr($number, $i, 8 - $i, 'utf8');
                    if ($target == $mynumber) {
                        $result = $i;
                    } else {
                        break;
                        //continue
                    }
                }
                if ($result != -1) {
                    echo "<br>號碼=" . $number . "<br>";
                    echo "中了{$awardStr[$result]}獎<br>";  //$awardStr 放在 base.php
                    $all_result = 1;
                }
                break;

            case 4:
                if ($award['number'] == mb_substr($number, 5, 3)) {
                    echo "<br>號碼=" . $number . "<br>";
                    echo "中了增開六獎";
                    $all_result = 1;
                }
                break;
        }
    }
}

if ($all_result == -1) {
    echo "槓估了QQ";
}


if (empty($award_numbers)) {
    echo "該期尚未開獎";
} 