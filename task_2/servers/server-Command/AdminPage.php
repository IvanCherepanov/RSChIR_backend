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
<h2>Задание 3</h2>
<div class="container">
    <form class="row g-3" method="GET">

        <div class="col-auto">
            <button type="submit" name="button1"  class="btn btn-primary mb-3">ls</button>
        </div>
        <div class="col-auto">
            <button type="submit" name="button2"  class="btn btn-primary mb-3">ps</button>
        </div>
        <div class="col-auto">
            <button type="submit" name="button3"  class="btn btn-primary mb-3">whoami</button>
        </div>
        <div class="col-auto">
            <button type="submit" name="button4"  class="btn btn-primary mb-3"> id</button>
        </div>
        <div class="col-auto">
            <button type="submit" name="button5"  class="btn btn-primary mb-3">pwd</button>
        </div>
    </form>
    <!--    <svg  viewPort="0 0 120 120">-->
    <!--        <ellipse cx="60" cy="60" rx="60" ry="30" fill=rgb(192,0,0) />-->
    <!--    </svg>-->

</div>
<?php
    include_once 'AdminCommand.php';

    if (array_key_exists('button1', $_GET )):
        print_r(AdminCommand::getAnswerCommand('ls'));
    elseif (array_key_exists('button2', $_GET)):
        print_r(AdminCommand::getAnswerCommand('ps'));
    elseif (array_key_exists('button3', $_GET)):
        print_r(AdminCommand::getAnswerCommand('whoami'));
    elseif (array_key_exists('button4', $_GET)):
        print_r(AdminCommand::getAnswerCommand('id'));
    elseif (array_key_exists('button5', $_GET)):
        print_r(AdminCommand::getAnswerCommand('pwd'));
    endif;
?>
</table>
</body>
</html>

