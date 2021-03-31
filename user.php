<?php
class user {

    function getUser($account, $password) {
        include 'database.php';
        $ret = false;
            $sql = "select * from users where account = '$account' and password ='$password'";
            $result = mysqli_query($db, $sql);
            $row = mysqli_num_rows($result);

        if($row){
            $ret = true;
        }

        return $ret;
    }

    function addUser($params) {
        include 'database.php';
        $sql = "INSERT INTO users (username, phone, overage, account, password)";
        $sql .= "VALUES ('".$params['username']."', ".$params['phone'].", ".$params['overage'].", '".$params['account']."', '".$params['password']."')";
        mysqli_query($db, $sql);
        $check = self::getUser($params['account'], $params['password']);

        return $check;
    }
}
?>