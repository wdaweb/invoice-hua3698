<?php include_once "base.php"; ?>

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
        <div class="col-lg-8 col-md-12 justify-content-around p-3 mx-auto border d-none d-md-flex alert-dark">
            <div class="">
                <a href="index.php">
                    <svg width="1.5rem" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>回首頁
                </a>
            </div>
            <div class="">
                <a href="?do=invoice_list">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                    </svg>發票存摺
                </a>
                <a href="?do=invoice_list" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">1111</a>
                    <a href="#" class="dropdown-item">1111</a>
                    <a href="#" class="dropdown-item">1111</a>
                </div>
            </div>
            <div class="btn-group">
                <a href="?do=award_numbers" type="button">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                    </svg>對獎專區
                </a>
                <a href="?do=award_numbers" type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></a>
                <div class="dropdown-menu">
                    <a href="?do=award_numbers&pd=2020-1" class="dropdown-item">
                        <li>1，2月</li>
                    </a>
                    <a href="?do=award_numbers&pd=2020-2" class="dropdown-item">
                        <li>3，4月</li>
                    </a>
                    <a href="?do=award_numbers&pd=2020-3" class="dropdown-item">
                        <li>5，6月</li>
                    </a>
                    <a href="?do=award_numbers&pd=2020-4" class="dropdown-item">
                        <li>7，8月</li>
                    </a>
                    <a href="?do=award_numbers&pd=2020-5" class="dropdown-item">
                        <li>9，10 月</li>
                    </a>
                    <a href="?do=award_numbers&pd=2020-6" class="dropdown-item">
                        <li>11，12月</li>
                    </a>
                </div>
            </div>
            <div class="">
                <a href="?do=add_awards">輸入獎號</a>
            </div>
            <div class="">
                <a href="#">領獎方式</a> <!-- https://invoice.cof.tw/lo.html -->
            </div>
        </div>

        <div class="navbar d-md-none d-flex justify-content-between alert-dark">
            <div class="">
                <a href="index.php">
                    <svg width="1.5rem" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>回首頁
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ml-auto">
                    <!-- active表示當前頁面 -->
                    <div class="">
                        <a href="?do=invoice_list">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                            </svg>發票存摺
                        </a>
                        <a href="?do=invoice_list" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">1111</a>
                            <a href="#" class="dropdown-item">1111</a>
                            <a href="#" class="dropdown-item">1111</a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="?do=award_numbers" type="button">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                            </svg>對獎專區
                        </a>
                        <a href="?do=award_numbers" type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></a>
                        <div class="dropdown-menu">
                            <a href="?do=award_numbers&pd=2020-1" class="dropdown-item">
                                <li>1，2月</li>
                            </a>
                            <a href="?do=award_numbers&pd=2020-2" class="dropdown-item">
                                <li>3，4月</li>
                            </a>
                            <a href="?do=award_numbers&pd=2020-3" class="dropdown-item">
                                <li>5，6月</li>
                            </a>
                            <a href="?do=award_numbers&pd=2020-4" class="dropdown-item">
                                <li>7，8月</li>
                            </a>
                            <a href="?do=award_numbers&pd=2020-5" class="dropdown-item">
                                <li>9，10 月</li>
                            </a>
                            <a href="?do=award_numbers&pd=2020-6" class="dropdown-item">
                                <li>11，12月</li>
                            </a>
                        </div>
                    </div>
                    <div class="">
                        <a href="?do=add_awards">輸入獎號</a>
                    </div>
                    <div class="">
                        <a href="#">領獎方式</a> <!-- https://invoice.cof.tw/lo.html -->
                    </div>
                </ul>
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
<?php $_SESSION['err'] = [];  //清除session 
?>