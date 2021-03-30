<?php
class user {

    function getUser($account, $password) {
        include 'database.php';
            $sql = "select * from users account = '$account' and password ='$password'";
            $result = mysqli_query($db, $sql);
            $row = mysqli_num_rows($result);

        if($row){
                echo '登入成功';
            }else{
                echo '帳號密碼錯誤';
        }
    }

    function addUser($username, $phone, $overage, $account, $password) {
        include 'database.php';
        $sql = "INSERT INTO users (username, phone, overage, account, password) VALUES ('$username', '$phone', '$overage', '$account', '$password')";
        mysqli_query($db, $sql);
        
        if ($db){
            echo '註冊成功';
        }else{
            echo '註冊失敗';
        }
    }
}

?>