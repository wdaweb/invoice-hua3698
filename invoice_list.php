<?php
include_once "base.php";

$period = ceil(date("m") / 2);

$sql = "select * from `invoices` where period='$period' order by date desc";

$rows = $pdo->query($sql)->fetchAll();
?>
<form action="">
<select name="" id="">
option*5</select>
</form>
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