<?php session_start();
include ('database.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>大廳</title>
    </head>
    <body>
        
        <?php
        $account = $_SESSION['account'];
        $data = new db;
        $lobby = $data -> dataUser($account);
        ?>

        <?php echo $account; ?>, 您好!<P>
        目前餘額：$ <?php echo($lobby['overage']) ?><P>
        <input type="button" name="edit" onclick="location.href='http://127.0.0.1/work/edit.php'" value="編輯">
        <input type="button" name="store" onclick="location.href='http://127.0.0.1/work/store_home.php'" value="儲值">
        <input type="button" name="search" onclick="location.href='http://127.0.0.1/work/search.php'" value="查詢注單"><p>
        <a href="http://127.0.0.1/work/playgame1.php?game=game1" title="Game1">Game1</a>
    </body>
</html>