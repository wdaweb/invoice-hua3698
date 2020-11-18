<?php
include_once "base.php";

$codeBase=["AB","FF","AC","CC","GG","KK"];
echo "資料產生中";
for($i=0;$i<1000;$i++){

    $code=$codeBase[rand(0,5)];
    $number=sprintf("%08d",rand(0,99999999));
    // 數字補零 (1) str_pad($number,8,'0')  (2) "%08d"
    $payment=rand(1,20000);
    
    $start=strtotime("2020-01-01");
    $end=strtotime("2020-12-31");
    $date=date("Y-m-d",rand($start,$end));
    $period=ceil(explode("-",$date)[1]/2);


    $hope=[
        'code'=>$code,
        'number'=>$number,
        'payment'=>$payment,
        'date'=>$date,
        'period'=>$period
    ];

    $sql="insert into invoices (`".implode("`,`",array_keys($hope))."`) values('".implode("','",$hope)."')";
    $pdo->exec($sql);
}



?>