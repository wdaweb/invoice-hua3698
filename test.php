<?php

include_once "base.php";

//取得單一筆資料
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
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    return $row;
}

// find("invoices",22);
// find("invoices",['code' => 'AB']);

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

// all('invoices')[10];
// all('invoices', ['code' => 'AB'])[10];
// all('invoices', " order by date desc")[10];
// all('invoices', ['period' => '2', 'payment' => '340'], " limit 5");


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

// $def =['code' =>'FF'];
// echo del('invoices', $def);  //echo後會回傳影響了幾列

// del('invoices',['payment'=>'15001']); 





//award_numbers
/*  <tbody>
            <tr>
                <th id="months">年/月份</th>
                可以用select option、toggle
                <td headers="months" class="title">
                    <?= $year; ?>年
                    <?php
                    $month = [
                        "1" => "01 ~ 02",
                        "2" => "03 ~ 04",
                        "3" => "05 ~ 06",
                        "4" => "07 ~ 08",
                        "5" => "09 ~ 10",
                        "6" => "11 ~ 12"
                    ];
                    echo $month[$period];
                    ?>月
                </td>
            </tr>
            <tr>
                <th id="specialPrize" rowspan="2">特別獎</th>
                <td class="number"><?= $special; ?></td>
            </tr>
            <tr>
                <td headers="specialPrize"> 同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元 </td>
            </tr>
            <tr>
                <th id="grandPrize" rowspan="2">特獎</th>
                <td class="number"><?= $grand; ?></td>
            </tr>
            <tr>
                <td headers="grandPrize"> 同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元 </td>
            </tr>
            <tr>
                <th id="firstPrize" rowspan="2">頭獎</th>
                <td headers="firstPrize" class="number">
                    加上中括號，使同一個name可以儲存多筆資料在陣列內 
                    <?php
                    foreach ($first as $f) {
                        echo $f . "<br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td headers="firstPrize"> 同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元 </td>
            </tr>
            <tr>
                <th id="addSixPrize">增開六獎</th>
                <td headers="addSixPrize" class="number">
                <?php
                foreach ($six as $s) {
                    echo $s . "<br>";
                }
                ?>
                </td>
            </tr>
        </tbody>  */