<?php
include_once "base.php";

if(isset($_GET['y']) && isset($_GET['p'])){
    $year=$_GET['y'] ;
    $period =$_GET['p'];
}else{
    $year=date("Y");
    $period = ceil(date("m") / 2);
}

if($period>=6){
    $nextPeriod=1;
    $nextYear=$year+1;
}else{
    $nextPeriod=$period+1;
    $nextYear=$year;
}
if($period<=1){
    $lastPeriod=6;
    $lastYear=$year-1;
}else{
    $lastPeriod=$period-1;
    $lastYear=$year;
}

// $period = ceil(date("m") / 2);
$sql = "select * from `invoices` where period='$period' && left(`date`,4)='$year' order by date desc";
$rows = $pdo->query($sql)->fetchAll();

?>


<h3 class="text-center">發票存摺</h3>
<ul>
<li>重新切版</li>
<li>顯示共有幾筆資料</li>
<li></li>
</ul>
<div class="navbar d-flex justify-content-around p-0">
    <a href="?do=invoice_list&y=<?=$lastYear?>&p=<?=$lastPeriod?>" style="text-decoration: none;">
        <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
    </a>
    <a href="">
        <?php
        echo date("Y", strtotime($year)) . "年{$month[$period]}";
        ?>
    </a>
    <a href="?do=invoice_list&y=<?=$nextYear?>&p=<?=$nextPeriod?>" style="text-decoration: none;">
        <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5A.5.5 0 0 0 4 8z" />
        </svg>
    </a>
</div>
<table class="table text-center">
    <tr>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
    </tr>
    <?php

//分頁
$sql_count="select count(*) from `invoices` where period='$period' && left(`date`,4)='$year'";
$rows_count=$pdo->query($sql_count)->fetch();
$per=10;
$pages=ceil($rows_count[0]/$per);

if(!isset($_GET["page"])){ 
    $page=1; //設定起始頁 
} else { 
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料 
    $page = ($page > 0) ? $page : 1; //確認頁數大於零 
    $page = ($pages > $page) ? $page : $pages; //確認使用者沒有輸入太神奇的數字 
}
$start = ($page-1)*$per;

$sql_show ="select * from `invoices` where period='$period' && left(`date`,4)='$year' order by date DESC LIMIT $start, $per ";
$rows_show =$pdo->query($sql_show)-> fetchAll();
    // print_r($rows_show);

    foreach ($rows_show as $row) {
    ?>
        <tr>
            <td><?= $row['code'] . "-" . $row['number'] . "<br>"; ?></td>
            <td><?= $row['date']; ?></td>
            <td><?php echo "$" . "{$row['payment']}元"; ?></td>
            <td class="d-none d-md-block">
                <a class="text-light" href="?do=edit_invoice&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-primary">編輯</button></a>
                <a class="text-light" href="?do=delete_invoice&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-danger">刪除</button></a>
                <a class="text-light" href="?do=award&id=<?= $row['id']; ?>"><button class="btn btn-sm btn-success">對獎</button></a>
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
<?php

for($i=1;$i<=$pages;$i++) { 
    echo '<a href="?do=invoice_list&page='.$i.'">' . $i . '</a>'; 
}
?>