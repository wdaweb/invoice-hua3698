<?php

include_once "base.php";



//target :印出下方語句
echo "欄位1='值1' && 欄位2='值2' && id='9'";

//solution :利用一個暫存的陣列來存放語句的片段
$array=['欄位1'=>'值1','欄位2'=>'值2','id'=>'9'];
foreach ($array as $key => $value) {
    $tmp[]=sprintf("`%s`='%s'",$key,$value);
    // $tmp[]="`".$key."`='".$value."'";
}
echo implode("&&",$tmp);

echo "<br>";

//寫法3. 
function find($table,$id){
    global $pdo;
    $sql_part="select * from $table where";
    if(is_array($id)){
        foreach ($id as $key => $value) {
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql_part.implode("&&",$tmp);
    }else{
        $sql=$sql_part."id='$id'";
    }
    $row=$pdo->query($sql)->fetch();

    return $row;
}

$row=find('invoices',['code'=>'AC','number'=>'93733665']);
echo $row['code'].$row['number']."<br>";


//寫法2. 加入判斷式的變化 
// function find($table,$id){
//     global $pdo;
//     if(is_numeric($id)){
//         $sql="select * from $table where id=$id";
//     }else{
//         $sql="select * from $table where $id";
//     }
//     $row=$pdo->query($sql)->fetch();

//     return $row;
// }

//原始寫法
// function find($table,$def){
//     global $pdo;
//     $sql="select * from $table where $def";
//     $row=$pdo->query($sql)->fetch();

//     return $row;
// }

$row=find('invoices',9);
echo $row['code'].$row['number']."<br>"; 

$row=find('invoices',"code='AC' && number='93733665'");
echo $row['code'].$row['number']."<br>";
//函式本身如果有return值，return的內容會直接給到find，因此find相當於是一個變數


?>