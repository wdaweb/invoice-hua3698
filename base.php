<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>統一發票紀錄及對獎系統</title>
    <link rel="stylesheet" href="plugins/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/style.css">
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- google font -->
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

function accept($field,$msg='此欄位不得為空'){
    if(empty($_POST[$field])){
        $_SESSION['err'][$field]['empty']=$msg;
    }
}

function length($field,$min,$max,$msg="長度不足"){
    if(strlen($_POST[$field])>$max || strlen($_POST[$field]) < $min){
        $_SESSION['err'][$field]['len']=$msg;
    }

}


function errFeedBack($field){
    if(!empty($_SESSION['err'][$field])){

        foreach($_SESSION['err'][$field] as $err){
            echo "<div style='font-size:12px;color:red'>";
            echo $err;
            echo "</div>";
        }
    }
}


//取得單一筆資料
function find($table, $id)
{
    global $pdo;
    $sql_part = "select * from $table where ";
    if (is_array($id)) {
        foreach ($id as $key => $value) {
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql = $sql_part . implode("&&", $tmp);
    } else {
        $sql = $sql_part . "id='$id'";
    }
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    return $row;
}

// ...$arg 會放進陣列裡存放，因此也可以不下參數->空陣列
function all($table, ...$arg)
{
    global $pdo;
    $sql_part = "select * from $table";

    if (isset($arg[0])) {
        if (is_array($arg[0])) {
            //製作會在where後面的句子 -> where ` `=' ';
            foreach ($arg[0] as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
            $sql = $sql_part . " where " . implode("&&", $tmp);
        } else {
            $sql = $sql_part . $arg[0];
        }
    } else {
        $sql = $sql_part;
    }

    if (isset($arg[1])) {
        //製作皆在最後面的句子字串
        $sql = $sql_part . $arg[1];
    }
    echo "<hr>" . $sql . "<br>";
    return $pdo->query($sql)->fetchAll();
}


function del($table, $id){
    global $pdo;
    $sql_part = "delete from $table where ";

    if (is_array($id)) {
        //製作會在where後面的句子 -> where ` `=' ';
        foreach ($id as $key => $value) {
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql = $sql_part . implode("&&", $tmp);
    } else {
        $sql = $sql_part . "id='$id'";
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