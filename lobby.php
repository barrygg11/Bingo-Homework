<?php
session_start();
include('database.php');

//使用switch來判斷是哪個按鈕觸發case用來判斷$_POST['btn']
switch($_POST['btn'])
{
    case "修改":
    btn1();
    break;

    case "儲值":
    btn2();
    break;

    default:
    break;
}

//btn1是修改按鈕
function btn1(){
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $account = $_SESSION['account'];
    $password = $_POST['password'];

    // if ($username =="" || $phone =="" || $account =="" || $password ==""){
    //     echo "<script>alert('內容請填寫完整'); location.href =  'edit.php'; </script>";
    //     exit;
    // }
    
    //修改會員資料
    $edit = new db;
    $edit->editUser($username, $phone, $account, $password);

    if($edit){
        echo "<script>alert('修改成功'); location.href =  'lobby_home.php'; </script>";
    }
}

//btn1是儲值按鈕
function btn2(){
    $account = $_SESSION['account'];
    $overage = $_POST['overage'];

    if ($account =="" || $overage ==""){
        echo "<script>alert('請輸入儲值金額'); location.href =  'store_home.php'; </script>";
        exit;
    }

    //這邊是提取資料庫上的金額加上儲值的金額
    $db = new db;
    $row = $db->selectmoneyUser($account, $overage);
    $total = $row["overage"] + $overage;
    //這邊是把加總的金額update上資料庫overage改成total
    $db->moneyUser($account, $total);


    if ($total){
        echo "<script>alert('新增成功'); location.href =  'lobby_home.php'; </script>";
        exit;
    }
}