<html lang="en">
<head>
<title>Hello world page</title>
    <link rel="stylesheet" href="../style.css" type="text/css"/>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<h1>Вторая работа по РСЧИР</h1>
<div class="container">
    <form class="row row-cols-lg-auto g-3 align-items-center">
        <label for="exampleFormControlInput1" class="form-label">Task 1</label>
        <p>Генерация картинки по числу</p>
        <div class="col-12">
            <button type="button" class="btn btn-primary" onclick="window.location.href='server-Drawer/DrawerPage.php'" >Submit</button>
        </div>
    </form>

    <form class="row row-cols-lg-auto g-3 align-items-center">
        <label for="exampleFormControlInput1" class="form-label">Task 2</label>
        <p>Сортировка чисел массива</p>
        <div class="col-12">
            <button type="button" class="btn btn-primary" onclick="window.location.href='server-Sorter/SorterPage.php'">Submit</button>
        </div>
    </form>

    <form class="row row-cols-lg-auto g-3 align-items-center">
        <label for="exampleFormControlInput1" class="form-label">Task 3</label>
        <p>Сервис для отображения команд</p>
        <div class="col-12">
            <button type="button" class="btn btn-primary" onclick="window.location.href='server-Command/AdminPage.php'">Submit</button>
        </div>
    </form>
</div>
<?php


?>
</table>
</body>
</html>