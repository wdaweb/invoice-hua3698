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
        svg{
            vertical-align: initial;
        }

        .nav {
            height: 10vh;
        }

        .container {
            height: 70vh;
        }
/*      footer {
            height: 10vh;
        } */
    </style>
</head>

<body>
    <p>nav的hover效果加深</p>
    <nav class="navbar navbar-expand-lg navbar-light mx-5 ">
        <a href="index.php" class="h3 mt-2">統一發票紀錄與對獎</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <svg width="1.2rem" height="1rem" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                        </svg>回首頁
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?do=invoice_list">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                        </svg>發票存摺
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="?do=award_numbers" id="navbarDropdown" data-toggle="dropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                        </svg>對獎專區
                    </a>
                    <div class="dropdown-menu">
                        <a href="?do=award_numbers&pd=2020-1" class="dropdown-item">1，2月</a>
                        <a href="?do=award_numbers&pd=2020-2" class="dropdown-item">3，4月</a>
                        <a href="?do=award_numbers&pd=2020-3" class="dropdown-item">5，6月</a>
                        <a href="?do=award_numbers&pd=2020-4" class="dropdown-item">7，8月</a>
                        <a href="?do=award_numbers&pd=2020-5" class="dropdown-item">9，10 月</a>
                        <a href="?do=award_numbers&pd=2020-6" class="dropdown-item">11，12月</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?do=add_awards">輸入獎號</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">領獎方式</a> <!-- https://invoice.cof.tw/lo.html -->
                </li>
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid px-5 m-0">
        <div class="container">
            <!-- <div class="col-lg-8 col-md-12 p-3 mx-auto"> -->
            <?php
            //這塊會根據輸入網址的值顯示不同區塊
            if (isset($_GET['do'])) {
                $file = $_GET['do'] . ".php";
                include $file;
            } else {
                include "main.php";
            }
            ?>
            <!-- </div> -->
        </div>
    </div>

</body>
<footer class="bg-secondary text-center text-light py-3">版權所有 @copyright</footer>

</html>
<?php $_SESSION['err'] = [];  //清除session 
?>