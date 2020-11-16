<?php
include_once "base.php";

$sql="select * from `invoices` order by date desc";

$rows=$pdo->query($sql)->fetchAll();
?>

<table class="table text-center">
    <tr style="background:#b4e2e8">
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
    </tr>
    <?php
    foreach ($rows as $row) {
        ?>    
    <tr>
        <td><?=$row['code']."-".$row['number']."<br>";?></td>
        <td><?=$row['date'];?></td>
        <td><?=$row['payment'];?></td>
        <td>
            <a class="text-light" href="?do=edit_invoice&id=<?=$row['id'];?>"><button class="btn btn-sm btn-primary">編輯</button></a>
            <a class="text-light" href="?do=delete_invoice&id=<?=$row['id'];?>"><button class="btn btn-sm btn-danger">刪除</button></a>
        </td>
    </tr>
    <?php
}
?>
</table>


