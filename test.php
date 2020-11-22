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



// <div class="p-3 mx-auto d-none d-md-flex">
// <a href="index.php" class="mr-auto h3">統一發票紀錄與對獎
//     <!-- <svg width="2rem" height="2rem" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
//         <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
//         <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
//     </svg> -->
// </a>
// <nav class="mr-5">
//     <a href="?do=invoice_list">
//         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
//             <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
//         </svg>發票存摺
//     </a>
//     <div class="btn-group">
//         <a href="?do=award_numbers" type="button">
//             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
//                 <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
//                 <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
//             </svg>對獎專區
//         </a>
//         <a href="?do=award_numbers" type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></a>
//         <div class="dropdown-menu">
//             <a href="?do=award_numbers&pd=2020-1" class="dropdown-item">
//                 <li>1，2月</li>
//             </a>
//             <a href="?do=award_numbers&pd=2020-2" class="dropdown-item">
//                 <li>3，4月</li>
//             </a>
//             <a href="?do=award_numbers&pd=2020-3" class="dropdown-item">
//                 <li>5，6月</li>
//             </a>
//             <a href="?do=award_numbers&pd=2020-4" class="dropdown-item">
//                 <li>7，8月</li>
//             </a>
//             <a href="?do=award_numbers&pd=2020-5" class="dropdown-item">
//                 <li>9，10 月</li>
//             </a>
//             <a href="?do=award_numbers&pd=2020-6" class="dropdown-item">
//                 <li>11，12月</li>
//             </a>
//         </div>
//     </div>
//     <a href="?do=add_awards">輸入獎號</a>
//     <a href="#">領獎方式</a> <!-- https://invoice.cof.tw/lo.html -->
// </nav>
// </div>

// <div class="navbar d-md-none d-flex p-1">
// <div class="">
//     <a href="index.php">
//         <svg width="1.5rem" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
//             <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
//             <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
//         </svg>統一發票紀錄與對獎
//     </a>
// </div>
// <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
//     <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
//         <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
//     </svg>
// </button>
// <div class="collapse navbar-collapse alert-dark" id="navbar">
//     <ul class="navbar-nav ml-auto">
//         <!-- active表示當前頁面 -->
//         <div class="">
//             <a href="?do=invoice_list">
//                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
//                     <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
//                 </svg>發票存摺
//             </a>
//         </div>


//         <div class="btn-group">
//             <a href="?do=award_numbers" type="button">
//                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
//                     <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
//                     <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
//                 </svg>對獎專區
//             </a>
//             <a href="?do=award_numbers" type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></a>
//             <div class="dropdown-menu">
//                 <a href="?do=award_numbers&pd=2020-1" class="dropdown-item">
//                     <li>1，2月</li>
//                 </a>
//                 <a href="?do=award_numbers&pd=2020-2" class="dropdown-item">
//                     <li>3，4月</li>
//                 </a>
//                 <a href="?do=award_numbers&pd=2020-3" class="dropdown-item">
//                     <li>5，6月</li>
//                 </a>
//                 <a href="?do=award_numbers&pd=2020-4" class="dropdown-item">
//                     <li>7，8月</li>
//                 </a>
//                 <a href="?do=award_numbers&pd=2020-5" class="dropdown-item">
//                     <li>9，10 月</li>
//                 </a>
//                 <a href="?do=award_numbers&pd=2020-6" class="dropdown-item">
//                     <li>11，12月</li>
//                 </a>
//             </div>
//         </div>


//         <div class="">
//             <a href="?do=add_awards">輸入獎號</a>
//         </div>
//         <div class="">
//             <a href="#">領獎方式</a> <!-- https://invoice.cof.tw/lo.html -->
//         </div>
//     </ul>
// </div>
// </div>


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