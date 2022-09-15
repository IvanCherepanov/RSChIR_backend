<html lang="en">
<head>
    <title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<!--style="background-color: #55D52B"-->
<body >
<h1>Вторая работа по РСЧИР</h1>
<h2>Задание 2</h2>
<h2>Вариант: (30-1)%5+1=5 Сортировка Шелла</h2>
<div class="container">
    <form class="row g-3" method="GET">
        <div class="col-auto">
            <input type="string" name="button1"  class="form-control" id="inputNumber" placeholder="1, 4, 6, 7">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </div>
    </form>
<!--    <svg  viewPort="0 0 120 120">-->
<!--        <ellipse cx="60" cy="60" rx="60" ry="30" fill=rgb(192,0,0) />-->
<!--    </svg>-->

</div>
<?php
    include_once 'ShellSort.php';
    include_once 'ConverterString.php';

    if (array_key_exists('button1', $_GET )){
        //print_r ($decoder->getParameters($_GET['button1']));
        print_r($_GET['button1']);
        echo "<br/>";
        ShellSort::outputArray(ShellSort::sort(ConverterString::filterString($_GET['button1'])));
        //print_r(ShellSort::sort(ConverterString::filterString($_GET['button1'])));
        //$drawer->draw($decoder->getParameters($_GET['button1']));
    }

?>
</table>
</body>
</html>
