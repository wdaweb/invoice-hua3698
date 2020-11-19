<?php include_once "base.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>統一發票紀錄及對獎系統</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        a:link {
            text-decoration: none;
        }

        .number {
            font-size: 1.2rem;
            color: red;
            font-weight: bolder;
        }

    </style>
</head>

<body class="p-5">

    <?php
    $month = [
        1 => "1,2月",
        2 => "3,4月",
        3 => "5,6月",
        4 => "7,8月",
        5 => "9,10月",
        6 => "11,12月"
    ];
    $m = ceil(date('m') / 2);
    ?>
    <h3 class="text-center">統一發票紀錄與對獎 <?= $month[$m]; ?></h3>

    <div class="container my-4">
        <div class="col-lg-8 col-md-12 d-flex justify-content-around p-3 mx-auto border">
            <div class="text-center">
                <a href="index.php">回首頁</a>
            </div>
            <div class="text-center">
                <a href="?do=invoice_list" >當期發票</a>
                <a href="?do=invoice_list" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" ></a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">1111</a>
                    <a href="#" class="dropdown-item">1111</a>
                    <a href="#" class="dropdown-item">1111</a>
                </div>
            </div>
            <div class="text-center btn-group">
                <a href="?do=award_numbers" type="button">對獎</a>
                <a href="?do=award_numbers" type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" ></a>
                <div class="dropdown-menu">
                    <a href="?do=award_numbers&pd=2020-1" class="dropdown-item"><li>1,2月</li></a>
                    <a href="?do=award_numbers&pd=2020-2" class="dropdown-item"><li>3,4月</li></a>
                    <a href="?do=award_numbers&pd=2020-3" class="dropdown-item"><li>5,6月</li></a>
                    <a href="?do=award_numbers&pd=2020-4" class="dropdown-item"><li>7,8月</li></a>
                    <a href="?do=award_numbers&pd=2020-5" class="dropdown-item"><li>9,10 月</li></a>
                    <a href="?do=award_numbers&pd=2020-6" class="dropdown-item"><li>11,12月</li></a>
                </div>
            </div>            
            <div class="text-center">
                <a href="?do=add_awards">輸入獎號</a>
            </div>
            <div class="text-center">
                <a href="#">領獎方式</a>  <!-- https://invoice.cof.tw/lo.html -->
            </div>
        </div>

        <div class="col-lg-8 col-md-12 p-3 mx-auto border">
            <?php
            //這塊會根據輸入網址的值顯示不同區塊

            if (isset($_GET['do'])) {
                $file = $_GET['do'] . ".php";
                include $file;
            } else {
                include "main.php";
            }
            ?>
        </div>
    </div>

</body>
</html>
<?php $_SESSION['err']=[];  //清除session ?>