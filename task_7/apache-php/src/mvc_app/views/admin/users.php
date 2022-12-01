<style>
    /* внешние границы таблицы серого цвета толщиной 1px */
    table {
        border: 1px solid grey;
        margin-left: auto;
        margin-right: auto;
    }

    /* границы ячеек первого ряда таблицы */
    th {
        border: 1px solid grey;
        font-size: 250%;
    }

    /* границы ячеек тела таблицы */
    td {
        border: 1px solid grey;
        font-size: 250%;
    }

    h1 {
        text-align: center;
    }
</style>
<div style="display: flex;flex-direction: column;">
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Surname</th>
        </tr>
    <?php
    foreach ($users as $row)
    { echo "<tr><td>{$row['ID']}</td><td>{$row['name']}</td><td>{$row['surname']}</td></tr>"; } ?>
</div>
<div>
    <?php
    phpinfo();
    ?>
</div>

