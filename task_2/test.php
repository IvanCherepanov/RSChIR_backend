<html>
<head>
    <title>Пример комбинации PHP и HTML</title>
</head>
<body>
<h1>Пример простого списка</h1>
<!-- Далее следует список. Это комментарий-->
<ul>
<?php
echo "<li> Первый элемент списка. <br>";
echo "Продолжение первого элемента списка</li><br>";
// Это однострочный комментарий
# Это тоже однострочный комментарий
echo "<li> <i>Второй элемент списка</i></li>";
/*
А это многострочный комментарий
*/
?>
</ul>
</body>
</html>
