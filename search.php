<?php
include('database.php');
$db = new db;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>查詢注單</title>
</head>
<body>
<form name="search" action="" method="post">
查詢玩家注單紀錄 : <input type="text" name="user_id" required><p>
<input type="submit" name="submit" value="查詢">
<input type ="button" onclick="javascript:location.href='http://127.0.0.1/work/lobby_home.php'" value="回上頁">
</form>
</body>
</html>

<?php

$user_id =0;

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
}

$result = $db -> searchBetSlip($user_id);
$row = mysqli_fetch_array($result);
$num = mysqli_num_rows($result);

// $total = $db -> goldTotal($user_id);

// $wingdd = $db -> wingddGoldTotal($user_id);

echo "總共".$num."筆"."<p>";
// echo "總下注金額：".$total['sum(gold)']."<p>";
// echo "輸贏金額：".$wingdd['sum(wingdd)']."<p>";

$total = 0;
$wingdd = 0;
foreach ($result as $row){
    echo "玩家：".$row['user_id']."<br>";
    echo "遊戲名稱：".$row['gtype']."<br>";
    echo "玩法：".$row['wtype']."<br>";
    echo "下注金額：".$row['gold']."<br>";
    echo "賠率：".$row['odd']."<br>";
    echo "結果：".$row['wingdd']."<br>";
    echo "下注時間：".$row['time']."<br>";
    echo "------------------------------"."<br>";
    $total+= $row['gold'];
    $wingdd+= $row['wingdd'];
}
echo "總下注金額：".$total;
echo "<br>";
echo "輸贏金額：".$wingdd;
?>