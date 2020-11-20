<?php
include_once "base.php";

$period = ceil(date("m") / 2);

$sql = "select * from `invoices` where period='$period' order by date desc";

$rows = $pdo->query($sql)->fetchAll();
?>
<div class="navbar d-flex justify-content-around p-0">
    <!-- <a href="index.php?y=<?= $lastYear ?>&m=<?= $lastMonth ?>" class="animate" style="text-decoration: none;"><< Last Month</a>  -->
    <a href="#" style="text-decoration: none;">
        <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
    </a>

    <a href="">
        <?php

        echo date("Y") . "年{$month[$m]}";

        ?>
    </a>
    <a href="#" style="text-decoration: none;">
        <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5A.5.5 0 0 0 4 8z" />
        </svg>
    </a>

</div>
<table class="table text-center my-3">
    <tr>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
    </tr>
    <?php
    foreach ($rows as $row) {
    ?>
        <tr>
            <td><?= $row['code'] . "-" . $row['number'] . "<br>"; ?></td>
            <td><?= $row['date']; ?></td>
            <td><?php echo "$" . "{$row['payment']}元"; ?></td>
            <td>
                <a class="text-light" href="?do=edit_invoice&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-primary">編輯</button></a>
                <a class="text-light" href="?do=delete_invoice&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-danger">刪除</button></a>
                <a class="text-light" href="?do=award&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-success">對獎</button></a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>