<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Valuable details</title>
    <style>
        td{
            padding: 5px;}
    </style>
</head>
<body>
<table>
    <tr><th>Price</th><th>Description</th></tr>
<?php require_once 'utilsMySql.php';
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
</html>
