<?php session_start();
include ('database.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>編輯會員資料系統</title>
    </head>
    <body>
        
    <?php
        $account = $_SESSION['account'];
        $data = new db;
        $lobby = $data -> dataUser($account);
    ?>
        <form name="edit" action="lobby.php" method="post">
        會員名稱 : <input type="text" name="username" value="<?php echo($lobby['username']) ?>"><p>
        手機 : <input type="text" name="phone" value="<?php echo($lobby['phone']) ?>"><p>
        帳號 : <input type="account" name="account" value="<?php echo $account; ?>" disabled><p>
        密碼 : <input type="password" name="password" value="<?php echo($lobby['password']) ?>"><p>
        <input type="submit" name="btn" value="修改">
        <input type="button" onclick="history.back()" value="回上頁"></input>
        </form>
    </body>
</html>