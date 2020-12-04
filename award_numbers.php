<!-- <p>button->alert (javascript)</p> -->
<?php
//對獎頁

include_once "base.php";

if (isset($_GET['pd'])) {
    $year = explode("-", $_GET['pd'])[0];
    $period = explode("-", $_GET['pd'])[1];
} else {
    $the_last_period = $pdo->query("select * from `award_numbers` order by `year` desc, `period` desc limit 1")->fetch();  //找出最新一期的資料
    $year = $the_last_period['year'];
    $period = $the_last_period['period'];
}

$awards = $pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchAll();
$special = "";
$grand = "";
$first = [];
$six = [];

foreach ($awards as $award) {
    switch ($award['type']) {
        case 1:
            $special = $award['number'];
            break;
        case 2:
            $grand = $award['number'];
            break;
        case 3:
            $first[] = $award['number'];
            break;
        case 4:
            $six[] = $award['number'];
            break;
    }
}
?>
<style>
    th,
    td {
        vertical-align: middle !important;
        text-align: center !important;
    }
</style>
<div class="row inv_list">
    <div class="col-2"></div>
    <div class="col-8 ">
        <h3 class="col-12 text-center">對獎專區</h3>
        <table class="table table-bordered table-hover my-3 bg-white">
            <tbody>
                <tr class="table-info">
                    <th>獎項</th>
                    <!-- 可以用select option、toggle -->
                    <th class="title">
                        <?= $year; ?>年
                        <?php
                        $month = [
                            "1" => "01 ~ 02",
                            "2" => "03 ~ 04",
                            "3" => "05 ~ 06",
                            "4" => "07 ~ 08",
                            "5" => "09 ~ 10",
                            "6" => "11 ~ 12"
                        ];
                        echo $month[$period];
                        ?>月
                    </th>
                    <th id="months">金額</th>
                </tr>
                <tr>
                    <th id="specialPrize">特別獎</th>
                    <td class="number"><?= $special; ?></td>
                    <td>與特別獎號碼相同者獎金1,000萬元</td>
                </tr>
                <tr>
                    <th id="grandPrize">特獎</th>
                    <td class="number"><?= $grand; ?></td>
                    <td>與特獎號碼相同者獎金200萬元</td>
                </tr>
                <tr>
                    <th id="firstPrize">頭獎~六獎</th>
                    <td class="number">
                        <!-- 加上中括號，使同一個name可以儲存多筆資料在陣列內 -->
                        <?php
                        foreach ($first as $f) {
                            echo $f . "<br>";
                        }
                        ?>
                    <td>
                        八碼與頭獎號碼相同者獎金20萬元<br>
                        末七碼與頭獎號碼相同者獎金4萬元<br>
                        末六碼與頭獎號碼相同者獎金1萬元<br>
                        末五碼與頭獎號碼相同者獎金4千元<br>
                        末四碼與頭獎號碼相同者獎金1千元<br>
                        末三碼與頭獎號碼相同者獎金2百元
                    </td>
                    </td>
                </tr>
                <tr>
                    <th id="addSixPrize">增開六獎</th>
                    <td class="number">
                        <?php
                        foreach ($six as $s) {
                            echo $s . "<br>";
                        }
                        ?>
                    <td>末3碼與增開六獎相同者獎金200元</td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-2"></div>

    <div class="col-12 d-flex justify-content-center py-3">
        <a href="?do=all_awards&year=<?= $year; ?>&period=<?= $period; ?>" class="col-2 font-weight-normal badge badge-pill badge-primary text-light p-3" style="font-size: 1rem;" id="arrow">中獎查詢</a>
    </div>
</div>