<?php
include_once "base.php";
$sql = "select * from invoices where id='{$_GET['id']}'";
$inv = $pdo->query($sql)->fetch();

// echo "<pre>";
// print_r($inv);
// echo "</pre>";
?>

<!-- 將某筆資料帶入參數，傳到其他網頁的方法 -->
<!-- 1. action="api/add_invoice.php?id=" -->
<!-- 2. <input type="hidden" name="id" value=""> -->

<div class="container px-5">
    <form action="api/update_invoice.php" method="post">
        <input type="hidden" name="id" value="<?= $inv['id']; ?>">
        <div class="form-group row">
            <label class="col-form-label col-3">發票號碼：</label>
            <input class="form-control col-2 col-md-1" type="text" name="code" value="<?= $inv['code']; ?>">-<input class="form-control col-4 col-md-3" type="number" name="number" value="<?= $inv['number']; ?>">
        </div>
        <div class="form-group row">
            <label class="col-form-label col-4 col-md-3">消費日期：</label>
            <input class="col-5 col-md-3 form-control" type="date" name="date" value="<?= $inv['date']; ?>">
        </div>
        <div class="form-group row">
            <label class="col-form-label col-4 col-md-3">消費金額：</label>
            <input class="col-5 col-md-3 form-control" type="text" name="payment" value="<?= $inv['payment']; ?>">
        </div>
        <div class="text-center">
            <input type="submit" value="確認修改" class="btn btn-sm btn-primary">
            <input type="reset" value="重置" class="btn btn-sm btn-secondary">
        </div>
    </form>
</div>