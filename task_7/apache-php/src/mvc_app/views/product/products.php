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
            <th>Desc</th>
            <th>Price</th>
        </tr>
    <?php
    $id = 'id';
    if ($lang == 'en'){
        foreach ($products as $row){
            echo "
        <tr>
            <td>
                <a href='en/itemShow.php?id={$row['ID']}'></a>
            </td>
            <td>{$row['description']}</td>
            <td>{$row['price']}</td>
        </tr>
        ";
        }
    }
    else {
        foreach ($products as $row){
            echo "
        <tr>
            <td>
                <a href='/itemShow.php?id={$row['ID']}'>{$row['description']}</a>
            </td>
            <td>{$row['description']}</td>
            <td>{$row['price']}</td>
        </tr>
        ";
        }
    }?>
</div>

