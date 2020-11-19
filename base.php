<?php

$dsn="mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo=new PDO($dsn,'root','');

date_default_timezone_set("Asia/Taipei");
session_start();

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

?>