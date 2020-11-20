<?php

include_once "base.php";

function find($table, $id)
{
    global $pdo;
    $sql_part = "select * from $table where";
    if (is_array($id)) {
        foreach ($id as $key => $value) {
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql = $sql_part . implode("&&", $tmp);
    } else {
        $sql = $sql_part . "id='$id'";
    }
    $row = $pdo->query($sql)->fetch();

    return $row;
}



// ...$arg 會放進陣列裡存放，因此也可以是不下參數->空陣列
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

all('invoices')[10];
all('invoices', ['code' => 'AB'])[10];
all('invoices', " order by date desc")[10];
all('invoices', ['period' => '2', 'payment' => '340'], " limit 5");


function del($table, $id){
    global $pdo;
    $sql_part = "delete from $table where";

    if (is_array($id)) {
        //製作會在where後面的句子 -> where ` `=' ';
        foreach ($id as $key => $value) {
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql = $sql_part . implode("&&", $tmp);
    } else {
        $sql = $sql_part . $id;
    }

    echo "<hr>" . $sql . "<br>";
    $row = $pdo->exec($sql);
    return $row;
}

$def = ['code' => 'FF'];
echo del('invoices', $def);  //echo後會回傳影響了幾列

del('invoices',['payment'=>'15001']); 
