<?php
// 刪除前的確認畫面
include_once "base.php";

    $inv=$pdo->query("select * from invoices where id='{$_GET['id']}'")->fetch();
    ?>

<div class="col-md-6 text-center border p-4 mx-auto">
    <div class="">確認要刪除以下發票嗎?</div>
    <ul class="list-group text-left">
        <li class="list-group-item">發票號碼：<?=$inv['code']."-".$inv['number'];?></li>
        <li class="list-group-item">消費日期：<?=$inv['date'];?></li>
        <li class="list-group-item">消費金額：<?=$inv['payment'];?></li>
    </ul>
    <div class="mt-4 text-light">
        <a href="api/del.php?&id=<?=$_GET['id'];?>"><button class="btn-sm btn-danger">確認刪除</button></a>
        <a href="?do=invoice_list"><button class="btn-sm btn-warning">取消</button></a> 
    </div>
</div>



