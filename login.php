<?php
include('user.php');

    $account = $_POST['account'];
    $password = $_POST['password'];

    if ($account =="" || $password =="" ){
        echo "請輸入帳號密碼";
        exit;
    }

$user = new user;
$ret = $user->getUser($account, $password);

if($ret){
    header("Location: http://127.0.0.1/work/lobby.html");
}else{
    echo "<script>alert('登入失敗'); location.href =  'login.html'; </script>";
}
