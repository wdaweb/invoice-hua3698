<?php

if(isset($_GET['year']) && isset($_GET['period'])){
    $year=$_GET['year'];
    $period=$_GET['period'];
}else {
    $year = date("Y");
    $period = ceil(date("m") / 2);
}
?>

<div id="aaa" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">這期全部槓估了</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>槓估了QQ槓估了QQ槓估了QQ槓估了QQ</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"><a href="index.php" class="text-light">存發票去Go</a></button>
            </div>
        </div>
    </div>
</div>

<div id="ooo" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">恭喜中獎</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>恭喜中獎！恭喜中獎！恭喜中獎！</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"><a href="index.php" class="text-light">存發票去Go</a></button>
            </div>
        </div>
    </div>
</div>


<div class="row inv_list">
    <h3 class="col-12 text-center">中獎查詢</h3>
    <h5 class="col-12 text-center">

        <?php
        include_once "base.php";

        echo "你要對的發票是" . $year . "年";
        echo $month[$period]. "的發票";
        ?>
    </h5>

    <?php
    //撈出該期的發票
    $sql = "select * from invoices where substr(`date`,1,4)='$year'  && `period`='$period' order by date desc";
    $invoices = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    // 找出年份的其他方法
    // left(`date`,4)='{$_GET['year']}' 
    //PDO取物件;兩個冒號::搜尋


    //撈出該期的開獎獎號
    $sql = " select * from award_numbers where `year`='$year' && `period`='$period'";
    $award_numbers = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);


    //開始對獎
    $all_result = -1;
    $prize[] = "";

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
                        echo "<div class='col-12 text-center'>";
                        echo "★ 發票號碼：" . $number . "、消費日期：".$date;
                        echo "、中獎獎別：特別獎、中獎金額：<span class='text-danger'>1千萬元</span>";
                        echo "</div>";
                        $all_result = 1;
                    }
                    break;
                case 2:
                    if ($award['number'] == $number) {
                        echo "<div class='col-12 text-center'>";
                        echo "★ 發票號碼：" . $number . "、消費日期：".$date;
                        echo "、中獎獎別：特獎、中獎金額：<span class='text-danger'>2百萬元</span>";
                        echo "</div>";
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
                        }
                    }
                    if ($result != -1) {
                        echo "<div class='col-12 text-center'>";
                        echo "★ 發票號碼：" . $number . "、消費日期：".$date;
                        echo "、中獎獎別：{$awardStr[$result]}獎、中獎金額：<span class='text-danger'>{$awardDollar[$result]}</span>";
                        echo "</div>";

                        //$awardStr 放在 base.php
                        $all_result = 1;
                    }
                    break;

                case 4:
                    if ($award['number'] == mb_substr($number, 5, 3)) {
                        echo "<div class='col-12 text-center'>";
                        echo "★ 發票號碼：" . $number . "、消費日期：".$date;
                        echo "、中獎獎別：增開六獎、中獎金額：<span class='text-danger'>200元</span>";
                        echo "</div>";
                        $all_result = 1;
                    }
                    break;
            }
        }
    }

    if ($all_result == -1) {
        ?>
        <script>$("#aaa").modal('show');</script>
    <?php
        echo "<img src='image/empty.jpg' class='w-50 m-auto'>";
    } else {
    ?>
        <script>$("#ooo").modal('show');</script>
    <?php
        echo "<img src='image/a.png' class='w-50 m-auto'>";
    }


    // if (empty($award_numbers)) {
    //     echo "該期尚未開獎";
    // }

    ?>


</div>