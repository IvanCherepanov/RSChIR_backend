<?php
require_once '../utilsMySql.php';
?>
<?php
$themeStyleSheet = 'http://localhost:8006/main.css';
if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
    $themeStyleSheet = 'http://localhost:8006/dark.css';
}
$favicon = "http://localhost:8006/img/hp.png";
if (!empty($_COOKIE['fav']) && $_COOKIE['fav'] == 'witcher') {
    $favicon = "http://localhost:8006/img/witch.png";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Valuable details</title>
    <link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon" id="fav-link">
    <link rel="stylesheet"
          href="<?php echo $themeStyleSheet; ?>"
          id="theme-link"
    />
    <style>
        td{
            padding: 5px;}
    </style>
</head>
<body>
<!--<div class="wrapper">-->
<!--    <div class="theme-button" id="theme-button">Change theme</div>-->
<!--    <div class="theme-button2" id="lang-button">Change lang</div>-->
<!--</div>-->
<table>
    <tr><th>Price</th><th>Description</th></tr>
<?php
    $id = $_GET[strtolower('id')];
    echo $id;
    if (!isset($id) || !is_numeric($id)) throw new Exception();

    $mysqli = openConnectionToDB();
    $statement = $mysqli->prepare('select * from products where ID = ?');
    $_id = intval($id);
    $statement->bind_param('i', $_id);
    $statement->execute();
    $item = $statement->get_result()->fetch_assoc();
    echo "
                    </tr>
                        <td>{$item['description']}</td>
                        <td>{$item['price']}</td>
                    </tr>
                
                    
                ";
    $mysqli->close();
?>
</body>
<script src="http://localhost:8006/cookies.js"></script>
</html>
