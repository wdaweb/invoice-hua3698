<?php

include_once "base.php";

$row=find('invoices',"id='9'");

echo $row['code']; 
echo $row['number'];
//函式本身如果有return值，return的內容會直接給到find，因此find相當於是一個變數


?>