<h1>Графики:</h1>
<div style=" display: flex;flex-direction: column;">
    <?php
    foreach ($images[0] as $image) {
        echo <<<A
            <div>
                <style="
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            ">
                <img src=$image alt="Here should be a picture"><span></span>
            </div> 
A;
    }
    ?>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Color</th>
        <th>Date</th>
        <th>Time</th>
        <th>Month</th>
        <th>Century</th>
        <th>CountryCode</th>
        <th>Number</th>
        <th>Latitude</th>
        <th>Longitude</th>
    </tr>
<?php
foreach ($images[1] as $data_row) {
    echo "<tr>";
    echo "<td>".$data_row->name."</td>";
    echo "<td>".$data_row->color."</td>";
    echo "<td>".$data_row->date."</td>";
    echo "<td>".$data_row->time."</td>";
    echo "<td>".$data_row->month."</td>";
    echo "<td>".$data_row->century."</td>";
    echo "<td>".$data_row->countryCode."</td>";
    echo "<td>".$data_row->number."</td>";
    echo "<td>".$data_row->latitude."</td>";
    echo "<td>".$data_row->longitude."</td>";
    echo "</tr>";
}
?>
</table>
