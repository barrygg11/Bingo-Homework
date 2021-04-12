<?php
session_start();
include('database.php');
$db = new db; //呼叫database的getGameOdds function
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Game1</title>
</head>
<body>
    <?php
    $account = $_SESSION['account'];
    echo "玩家：".$account."<p>";
    ?>
<form name="game1" action="" method="post">
大: <input type="text" required name="big" value="0"></p>
小: <input type="text" required name="small" value="0"></p>
單: <input type="text" required name="single" value="0"></p>
雙: <input type="text" required name="double" value="0"></p>
<input type="submit" name="submit" value="下注">
<input type ="button" onclick="javascript:location.href='http://127.0.0.1/work/lobby_home.php'" value="回上頁">
</form>
</body>
</html>

<?php

$gtype = $_GET['game'];    //接收url參數 傳到資料庫判斷是哪款遊戲
$big = 0;
$small = 0;
$single = 0;
$double = 0;

//判斷POST預設值
if (isset($_POST['big']) || isset($_POST['small']) || isset($_POST['single']) || isset($_POST['double'])) {
    $big = $_POST['big'];
    $small = $_POST['small'];
    $single = $_POST['single'];
    $double = $_POST['double'];
}

$post_data = array(
    'big' => $big,
    'small' => $small,
    'single' => $single,
    'double' => $double
);

$total = $post_data['big'] + $post_data['small'] + $post_data['single'] +$post_data['double']; //下注總金額

echo "<br>";
echo "總下注：".$total;
echo "<br>";

$gameResult = rand(1,6);  //賓果隨機數自動產生
echo "賽果：".$gameResult;

function getOdd($gtype){
    $db = new db;
    $data = $db -> getGameOdds($gtype);
    $one＿array = array_reduce($data, "array_merge_recursive",[]);
    $all_odd = array(
        'big' => $one＿array[0],
        'small' => $one＿array[1],
        'single' => $one＿array[2],
        'double' => $one＿array[3]
    );
    return $all_odd;
}
echo "<br>";
$all_odd = getOdd($gtype);



//遊戲玩法
$big_wtype = "big";
$small_wtype = "small";
$single_wtype = "single";
$double_wtype = "double";

$all_wtype = array (
    'big' => $big_wtype,
    'small' => $small_wtype,
    'single' => $single_wtype,
    'double' => $double_wtype
);

//金額*賠率
$big_wingdd = $big * $all_odd['big'];
$small_wingdd = $small * $all_odd['small'];
$single_wingdd = $single * $all_odd['single'];
$double_wingdd = $double * $all_odd['double'];

$all_wingdd = array (
    'big' => $big_wingdd,
    'small' => $small_wingdd,
    'single' => $single_wingdd,
    'double' => $double_wingdd
);

echo "<br>";

// big 判斷輸贏，贏的話寫入database

if ($gameResult > 3 && $post_data['big'] > 0){
    $db -> insertGame1Result($account,$gtype,$all_wtype['big'],$post_data['big'],$all_odd['big'],$all_wingdd['big']);
}else if($post_data['big'] > 0){
    $db -> insertGame1Result($account,$gtype,$all_wtype['big'],$post_data['big'],$all_odd['big'],-$all_wingdd['big']);
}

// small

if ($gameResult < 4 && $post_data['small'] > 0){
    $db -> insertGame1Result($account,$gtype,$all_wtype['small'],$post_data['small'],$all_odd['small'],$all_wingdd['small']);
}elseif($post_data['small'] > 0){
    $db -> insertGame1Result($account,$gtype,$all_wtype['small'],$post_data['small'],$all_odd['small'],-$all_wingdd['small']);
}

// single

if (($gameResult == "1" || $gameResult == "3" || $gameResult == "5") && ($post_data['single'] > 0)){
    $db -> insertGame1Result($account,$gtype,$all_wtype['single'],$post_data['single'],$all_odd['single'],$all_wingdd['single']);
}elseif($post_data['single'] > 0){
    $db -> insertGame1Result($account,$gtype,$all_wtype['single'],$post_data['single'],$all_odd['single'],-$all_wingdd['single']);
}

// double

if (($gameResult == "2" || $gameResult == "4" || $gameResult == "6") && ($post_data['double'] > 0)){
    $db -> insertGame1Result($account,$gtype,$all_wtype['double'],$post_data['double'],$all_odd['double'],$all_wingdd['double']);
}elseif($post_data['double'] > 0){
    $db -> insertGame1Result($account,$gtype,$all_wtype['double'],$post_data['double'],$all_odd['double'],-$all_wingdd['double']);
}

echo "<br>";
echo "--------------------------------------------";
echo "<br>";
echo "<br>";

//用switch 判斷輸贏結果
switch($gameResult)
{
    case 1: //小,單=贏  大,雙=輸
        echo "注項大"."->"."下注金額：$big".", 輸 "."結果：".-$all_wingdd['big']."<br>";
        echo "注項小"."->"."下注金額：$small".", 贏 "."結果：".$all_wingdd['small']."<br>";
        echo "注項單"."->"."下注金額：$single".", 贏 "."結果：".$all_wingdd['single']."<br>";
        echo "注項雙"."->"."下注金額：$double".", 輸 "."結果：".-$all_wingdd['double']."<br>";
    break;

    case 2: //小,雙=贏  大,單=輸
        echo "注項大"."->"."下注金額：$big".", 輸 "."結果：".-$all_wingdd['big']."<br>";
        echo "注項小"."->"."下注金額：$small".", 贏 "."結果：".$all_wingdd['small']."<br>";
        echo "注項單"."->"."下注金額：$single".", 輸 "."結果：".-$all_wingdd['single']."<br>";
        echo "注項雙"."->"."下注金額：$double".", 贏 "."結果：".$all_wingdd['double']."<br>";
    break;

    case 3: //小,單=贏  大,雙=輸
        echo "注項大"."->"."下注金額：$big".", 輸 "."結果：".-$all_wingdd['big']."<br>";
        echo "注項小"."->"."下注金額：$small".", 贏 "."結果：".$all_wingdd['small']."<br>";
        echo "注項單"."->"."下注金額：$single".", 贏 "."結果：".$all_wingdd['single']."<br>";
        echo "注項雙"."->"."下注金額：$double".", 輸 "."結果：".-$all_wingdd['double']."<br>";
    break;

    case 4: //大,雙=贏  小,單=輸
        echo "注項大"."->"."下注金額：$big".", 贏 "."結果：".$all_wingdd['big']."<br>";
        echo "注項小"."->"."下注金額：$small".", 輸 "."結果：".-$all_wingdd['small']."<br>";
        echo "注項單"."->"."下注金額：$single".", 輸 "."結果：".-$all_wingdd['single']."<br>";
        echo "注項雙"."->"."下注金額：$double".", 贏 "."結果：".$all_wingdd['double']."<br>";
    break;

    case 5: //大,單=贏  小,雙=輸
        echo "注項大"."->"."下注金額：$big".", 贏 "."結果：".$all_wingdd['big']."<br>";
        echo "注項小"."->"."下注金額：$small".", 輸 "."結果：".-$all_wingdd['small']."<br>";
        echo "注項單"."->"."下注金額：$single".", 贏 "."結果：".$all_wingdd['single']."<br>";
        echo "注項雙"."->"."下注金額：$double".", 輸 "."結果：".-$all_wingdd['double']."<br>";
    break;

    case 6: //大,雙=贏  小,單=輸
        echo "注項大"."->"."下注金額：$big".", 贏 "."結果：".$all_wingdd['big']."<br>";
        echo "注項小"."->"."下注金額：$small".", 輸 "."結果：".-$all_wingdd['small']."<br>";
        echo "注項單"."->"."下注金額：$single".", 輸 "."結果：".-$all_wingdd['single']."<br>";
        echo "注項雙"."->"."下注金額：$double".", 贏 "."結果：".$all_wingdd['double']."<br>";
    break;

    default:
    break;
}