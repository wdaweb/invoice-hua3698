<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= title(); ?>統一發票紀錄與對獎</title>
    <link rel="stylesheet" href="plugins/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/style.css">
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">  <!-- logo -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />  <!-- animation -->
    <!-- google font字型 -->
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&family=Open+Sans&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/b6159c26a6.js" crossorigin="anonymous"></script> <!-- font awesome -->
    <script src="plugins/jquery-3.5.1.min.js"></script>
    <script src="plugins/bootstrap.bundle.min.js"></script>

</head>

<?php

$dsn="mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo=new PDO($dsn,'root','');

date_default_timezone_set("Asia/Taipei");
session_start();

$month = [
    1 => "1、2月",
    2 => "3、4月",
    3 => "5、6月",
    4 => "7、8月",
    5 => "9、10月",
    6 => "11、12月"
];
$m = ceil(date('m') / 2);

$awardStr=['頭','二','三','四','五','六'];
$awardDollar=['20萬元','4萬元','1萬元','4000元','1000元','200元'];

function title(){
    if(isset($_GET['do'])){
        switch ($_GET['do']){
            case 'invoice_list':
                echo "發票存摺 | ";
            break;
            case 'award_numbers':   
                echo "開獎號碼 | ";
            break;
            case 'add_awards':  
                echo "輸入獎號 | ";
            break;
            case 'all_awards':
                echo "中獎查詢 | ";
            break;
        }
    }
}

//取得單一筆資料
function find($table, $id){
    global $pdo;
    $sql = "select * from $table where ";
    if (is_array($id)) {
        foreach ($id as $key => $value) {
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql = $sql . implode("&&", $tmp);
    } else {
        $sql = $sql . "id='$id'";
    }
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r ($tmp);
    echo"</pre>" ;
    // return $row;
}

// ...$arg 會放進陣列裡存放，因此也可以不下參數->空陣列
function all($table, ...$arg)
{
    global $pdo;
    $sql = "select * from $table";

    if (isset($arg[0])) {
        if (is_array($arg[0])) {
            //製作會在where後面的句子 -> where ` `=' ';
            foreach ($arg[0] as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
            $sql = $sql . " where " . implode("&&", $tmp);
        } else {
            $sql = $sql . $arg[0];
        }
    } else {
        $sql = $sql;
    }

    if (isset($arg[1])) {
        //製作皆在最後面的句子字串
        $sql = $sql . $arg[1];
    }
    echo "<hr>" . $sql . "<br>";
    return $pdo->query($sql)->fetchAll();
}


function del($table, $id){
    global $pdo;
    $sql = "delete from $table where ";

    if (is_array($id)) {
        //製作會在where後面的句子 -> where ` `=' ';
        foreach ($id as $key => $value) {
            $tmp[] = sprintf("`%s`='%s'", $key, $value);  //%s 字串的意思
        }
        $sql = $sql . implode("&&", $tmp);
    } else {
        $sql = $sql . "id='$id'";
    }

    $row = $pdo->exec($sql);
    return $row;
}


function update($table,$array){
    global $pdo;
    $sql="update $table set ";
    foreach ($array as $key => $value) {
        if($key != 'id'){
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
    }
    $sql=$sql.implode(",",$tmp). " where `id`='{$array['id']}' ";
    $pdo->exec($sql);
}

function insert($table,$array){
    global $pdo;
    $sql="insert into $table(`".implode("`,`",array_keys($array))."`) values('".implode("','",$array)."')";

    $pdo->exec($sql);
}

//合併update&insert
function save($table,$array){
    if(isset($array['id'])){
        update($table,$array);
    }else{
        insert($table,$array);
    }
}

function to($url){
    header("location:".$url);
}

function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}

?>