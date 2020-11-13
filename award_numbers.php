<?php
include_once "base.php";

if(isset($_GET['pd'])){
    $year=explode("-",$_GET['pd'])[0];
    $period=explode("-",$_GET['pd'])[1];
}else{
    $the_last_period=$pdo->query("select * from `award_numbers` order by year desc, period desc limit 1")->fetch();
    $year=$the_last_period['year'];
    $period=$the_last_period['period'];    
}

$awards=$pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchAll();
$special="";
$grand="";
$first=[];
$six=[];

foreach ($awards as $award) {
    switch($award['type']){
        case 1:
            $special=$award['number'];
        break;
        case 2:
            $grand=$award['number'];
        break;
        case 3:
            $first[]=$award['number'];
        break;
        case 4:
            $six[]=$award['number'];
        break;
    }
}
?>
<table class="table table-bordered table-sm mx-auto" summary="統一發票中獎號碼單">
        <tbody>
            <tr>
                <th id="months">年/月份</th>
                <!-- 可以用select option、toggle -->
                <td headers="months" class="title">
                    <?=$year;?>年
                    <?php
                    $month=[
                        "1"=>"01 ~ 02",
                        "2"=>"03 ~ 04",
                        "3"=>"05 ~ 06",
                        "4"=>"07 ~ 08",
                        "5"=>"09 ~ 10",
                        "6"=>"11 ~ 12"
                    ];
                    echo $month[$period];
                    ?>月
                </td>
            </tr>
            <tr>
                <th id="specialPrize" rowspan="2">特別獎</th>
                <td class="number"><?=$special;?></td>
            </tr>
            <tr>
                <td headers="specialPrize"> 同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元 </td>
            </tr>
            <tr>
                <th id="grandPrize" rowspan="2">特獎</th>
                <td class="number"><?=$grand;?></td>
            </tr>
            <tr>
                <td headers="grandPrize"> 同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元 </td>
            </tr>

            <tr>
                <th id="firstPrize" rowspan="2">頭獎</th>
                <td headers="firstPrize" class="number">
                    <!-- 加上中括號，使同一個name可以儲存多筆資料在陣列內 -->
                    <?php
                        foreach ($first as $f) {
                            echo $f."<br>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td headers="firstPrize"> 同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元 </td>
            </tr>
            <tr>
                <th id="addSixPrize">增開六獎</th>
                <td headers="addSixPrize" class="number">
                <?php
                        foreach ($six as $s) {
                            echo $s."<br>";
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>