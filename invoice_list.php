<?php
include_once "base.php";

if (isset($_GET['y']) && isset($_GET['p'])) {
    $year = $_GET['y'];
    $period = $_GET['p'];
} else {
    $year = date("Y");
    $period = ceil(date("m") / 2);
}

if ($period >= 6) {
    $nextPeriod = 1;
    $nextYear = $year + 1;
} else {
    $nextPeriod = $period + 1;
    $nextYear = $year;
}
if ($period <= 1) {
    $lastPeriod = 6;
    $lastYear = $year - 1;
} else {
    $lastPeriod = $period - 1;
    $lastYear = $year;
}

// $period = ceil(date("m") / 2);
// $sql = "select * from `invoices` where period='$period' && left(`date`,4)='$year' order by date desc";
// $rows = $pdo->query($sql)->fetchAll();

//總花費
$sql_payment = " select sum(`payment`) from `invoices` where period='$period' && left(`date`,4)='$year' ";
$rows_payment = $pdo->query($sql_payment)->fetch(PDO::FETCH_NUM);

//分頁
$sql_count = "select count(*) from `invoices` where period='$period' && left(`date`,4)='$year'";
$rows_count = $pdo->query($sql_count)->fetch(PDO::FETCH_NUM);
$per = 10;
$pages = ceil($rows_count[0] / $per);

if (!isset($_GET["page"])) {
    $page = 1; //設定起始頁 
} else {
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料 
    $page = ($page > 0) ? $page : 1; //確認頁數大於零 
    $page = ($pages > $page) ? $page : $pages; //確認使用者沒有輸入太神奇的數字 
}
$start = ($page - 1) * $per;

$sql_show = "select * from `invoices` where period='$period' && left(`date`,4)='$year' order by date DESC LIMIT $start, $per ";
$rows_show = $pdo->query($sql_show)->fetchAll();
?>

<div class="row inv_list">
    <h3 class="text-center col-12">發票存摺</h3>
    <div class="col-12">
        <div id="period" class="d-flex justify-content-around pb-3">
            <a href="?do=invoice_list&y=<?= $lastYear ?>&p=<?= $lastPeriod ?>"><i class="fas fa-chevron-left"></i></a>
            <span class="text-primary">
                <?php
                echo date("Y", strtotime($year)) . "年{$month[$period]}";
                ?>
            </span>
            <a href="?do=invoice_list&y=<?= $nextYear ?>&p=<?= $nextPeriod ?>"><i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="text-center my-3">一共存了
            <span class='text-danger'><?= $rows_count[0]; ?></span>張發票，總花費
            <span class='text-danger'><?= $rows_payment[0]; ?></span>元
        </div>
        <!-- <div class="text-info float-right">第<?= $page; ?>頁，共<?= $pages; ?>頁</div> -->

        <table class="table text-center col-12">
            <tr>
                <td>對獎結果</td>
                <td>發票號碼</td>
                <td>消費日期</td>
                <td>消費金額</td>
                <td>操作</td>
            </tr>

            <?php
            foreach ($rows_show as $row) {
            ?>
                <tr>
                    <!-- 單一發票對獎 -->
                    <td class="<?= $tmp; ?>">
                        <?php
                        $inv_id = $row['id'];
                        $inv_number = $row['number'];
                        $inv_date = $row['date'];
                        $inv_year = explode('-', $inv_date)[0];
                        $inv_period = ceil(explode('-', $inv_date)[1] / 2);  /* 得到該月所屬期數 */
                        $awards = $pdo->query("select * from award_numbers where year='$inv_year' && period='$inv_period'")->fetchAll();
                        $all_result = -1;
                        foreach ($awards as $award) {
                            switch ($award['type']) {
                                case 1:
                                    if ($award['number'] == $inv_number) {
                                        echo "中了特別獎";
                                        $all_result = 1;
                                    }
                                    break;
                                case 2:
                                    if ($award['number'] == $inv_number) {
                                        echo "中了特獎";
                                        $all_result = 1;
                                    }
                                    break;
                                case 3:
                                    $result = -1;
                                    for ($i = 5; $i >= 0; $i--) {
                                        $target = mb_substr($award['number'], $i, 8 - $i, 'utf8');
                                        $mynumber = mb_substr($inv_number, $i, 8 - $i, 'utf8');
                                        if ($target == $mynumber) {
                                            $result = $i;
                                        } else {
                                            break;
                                            //continue
                                        }
                                    }
                                    if ($result != -1) {
                                        echo "中了{$awardStr[$result]}獎<br>";  //$awardStr 放在 base.php
                                        $all_result = 1;
                                    }
                                    break;
                                case 4:
                                    if ($award['number'] == mb_substr($inv_number, 5, 3)) {
                                        echo "中了增開六獎";
                                        $all_result = 1;
                                    }
                                    break;
                            }
                        }
                        if ($all_result !== -1) {
                            $tmp = "text-danger";
                        } else {
                            $tmp = "text-secondary";
                            echo "槓估了QQ";
                        }
                        ?>
                    </td>
                    <td><?= $row['code'] . "-" . $row['number'] . "<br>"; ?></td>
                    <td><?= $row['date']; ?></td>
                    <td><?php echo "$" . "{$row['payment']}元"; ?></td>
                    <td class="d-none d-md-block">
                        <a class="text-light" href="?do=edit_invoice&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-primary">編輯</button></a>
                        <a class="text-light" href="?do=delete_invoice&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-danger">刪除</button></a>
                        <!-- <a class="text-light" href="?do=award&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">對獎</button></a> -->
                    </td>
                    <td class="d-block d-md-none">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                        </svg>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <div class="pagination m-auto py-5 text-center">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php
        for ($i = 1; $i <= $pages; $i++) {
            if ($i == $page) {
                echo "<li class='page-item'><a class='bg-info page-link text-white' href='?do=invoice_list&page=" . $i . "'>" . $i . "</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link text-info' href='?do=invoice_list&page=" . $i . "'>" . $i . "</a></li>";
            }
        }
        ?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <div class="text-info ml-3 mt-2">
            第<?= $page; ?>頁，共<?= $pages; ?>頁
        </div>
    </div>
</div>


<!-- <div class="btn-toolbar m-auto py-5">
        <div class="btn-group text-center">
        <?php
        for ($i = 1; $i <= $pages; $i++) {
            if ($i == $page) {
                echo "<a class='btn btn-danger text-white' href='?do=invoice_list&page=" . $i . "'>" . $i . "</a>";
            } else {
                echo "<a class='btn btn-outline-info text-info' href='?do=invoice_list&page=" . $i . "'>" . $i . "</a>";
            }
        }
        ?>
        </div>
        <div class="text-info ml-3 mt-2">
            第<?= $page; ?>頁，共<?= $pages; ?>頁
        </div>
    </div> -->