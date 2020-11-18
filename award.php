<?php
//單一發票對獎
include_once "base.php";

$inv_id = $_GET['id'];

$invoice = $pdo->query("select * from invoices where id='$inv_id'")->fetch();
$number = $invoice['number'];

//找出獎號
/*
1.確認期數->發票日期做分析
2.得到期數的資料後，撈出該期的開獎獎號
*/

$date = $invoice['date'];
//explode('-',$date)取得日期資料的陣列，陣列的第二個元素就是月份
//就可以推算期數，有了期數及年份就可以找到開獎的號碼
//$array=explode('-',$date)
//$month=$array[1]
//$period=ceil(month/2)
$year = explode('-', $date)[0];
$period = ceil(explode('-', $date)[1] / 2);  /* 得到該月所屬期數 */
// echo "select * from award_numbers where year='$year' && period='$period'";
$awards = $pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchAll();

// echo "<pre>";
// print_r($awards);
// echo"</pre>";
$all_result=-1;

foreach ($awards as $award) {
    switch ($award['type']) {
        case 1:
            if ($award['number'] == $number) {
                echo "<br>號碼=" . $number . "<br>";
                echo "中了特別獎";
                $all_result=1;
            }
            break;
        case 2:
            if ($award['number'] == $number) {
                echo "<br>號碼=" . $number . "<br>";
                echo "中了特獎";
                $all_result=1;
            }
            break;
        case 3:
            $result=-1;
            for ($i = 5; $i >= 0; $i--) {
                $target = mb_substr($award['number'], $i, 8 - $i,'utf8');
                $mynumber = mb_substr($number, $i, 8 - $i,'utf8');
                if ($target == $number) {
                    $result=$i;
                } else {
                    break;
                    //continue
                }
            }
            if($result!=-1){
                echo "<br>號碼=" . $number . "<br>";
                echo "中了{$awardStr[$result]}獎<br>";  //$awardStr 放在 base.php
                $all_result=1;
            }
        break;
        case 4:
            if($award['number']==mb_substr($number,5,3)){
                echo "<br>號碼=".$number."<br>";
                echo "中了增開六獎";
                $all_result=1;
            }
            break;
    }
}

if($all_result==-1){
    echo "槓估了QQ";
}
?>

<a href="?do=invoice_list" class="d-flex justify-content-end">回上一頁</a>

<!-- 當中獎了 如何顯示金額 -->