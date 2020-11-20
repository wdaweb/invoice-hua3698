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


// function find($table,$def){
//     global $pdo;
//     $sql="select * from $table where $def";
//     $row=$pdo->query($sql)->fetch();

//     return $row;
// }


?>