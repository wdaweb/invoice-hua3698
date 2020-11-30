<?php include_once "base.php"; ?>


<body>
    <!-- 選單區 -->
    <header class="bg-light">
        <nav class="container navbar navbar-expand-lg navbar-light">
            <a href="index.php" class="navbar-brand text-dark">
                <img src="image/favicon.ico" width="25px" class="pb-2 mr-2">統一發票紀錄與對獎
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse pt-2" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <!-- <li class="nav-item <?= (empty($_GET['do'])) ? 'active' : ""; ?>">
                    <a class="nav-link" href="index.php">
                        <svg width="1.2rem" height="1rem" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                        </svg>回首頁
                    </a>
                    </li> -->
                    <li class="nav-item <?= (isset($_GET['do']) && $_GET['do'] == 'invoice_list') ? 'active' : ""; ?>">
                        <a class="nav-link" href="?do=invoice_list">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                            </svg>發票存摺
                        </a>
                    </li>
                    <li class="nav-item  <?= (isset($_GET['do']) && $_GET['do'] == 'award_numbers') ? 'active' : ""; ?>">
                        <div class="btn-group">
                            <a href="?do=award_numbers" class="btn nav-link">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                                </svg>開獎號碼
                            </a>
                            <a href="?do=award_numbers" class="btn dropdown-toggle dropdown-toggle-split pl-0" data-toggle="dropdown"></a>
                            <div class="dropdown-menu">
                                <a href="?do=award_numbers&pd=2020-1" class="dropdown-item">1，2月</a>
                                <a href="?do=award_numbers&pd=2020-2" class="dropdown-item">3，4月</a>
                                <a href="?do=award_numbers&pd=2020-3" class="dropdown-item">5，6月</a>
                                <a href="?do=award_numbers&pd=2020-4" class="dropdown-item">7，8月</a>
                                <a href="?do=award_numbers&pd=2020-5" class="dropdown-item">9，10 月</a>
                                <a href="?do=award_numbers&pd=2020-6" class="dropdown-item">11，12月</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item  <?= (isset($_GET['do']) && $_GET['do'] == 'add_awards') ? 'active' : ""; ?>">
                        <a class="nav-link" href="?do=add_awards">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-paperclip" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
                            </svg>輸入獎號
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trophy" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z" />
                            </svg>中獎查詢
                        </a> <!-- https://invoice.cof.tw/lo.html -->
                    </li>
                </ul>
                <span>會員登入/註冊</span>
            </div>
        </nav>
    </header>

    <!-- 內容區 -->
    <div class="container py-5 " style="min-height:680px" id="header">

            <?php
            //這塊會根據輸入網址的值顯示不同區塊
            if (isset($_GET['do'])) {
                $file = $_GET['do'] . ".php";
                $a = "active";
                include $file;
            } else {
                include "main.php";
            }
            ?>
        <!-- </div> -->
    </div>

    <!-- <footer class="bg-dark text-muted text-center py-2">
        <a href="#header" class="btn btn-outline-info position-fixed"><i class="far fa-arrow-alt-circle-up fa-2x"></i></a>
        <small>泰山職訓中心課程教材練習<br> copyright &#169; <span class="text-warning">05xxx設計</span> . All right reserved </small>
    </footer> -->
</body>

</html>
<?php $_SESSION['err'] = [];  //清除session 
?>