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
    ?>
        <form name="edit" action="lobby.php" method="post">
        會員名稱 : <input type="text" name="username"><p>
        手機 : <input type="text" name="phone"><p>
        帳號 : <input type="account" name="account" value="<?php echo $account; ?>" disabled><p>
        密碼 : <input type="password" name="password"><p>
        <input type="submit" name="submit" value="送出">
        <input type="button" onclick="history.back()" value="回上頁"></input>
        </form>
    </body>
</html>