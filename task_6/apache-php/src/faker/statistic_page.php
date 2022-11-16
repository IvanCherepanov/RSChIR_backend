<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 6</title>
</head>
<body>
<?php
require_once "generator.php";

generate_data();
?>
<?php
require_once "simple_pie_plot.php";
require_once "plot_bar.php";
require_once "line_plot.php";
require_once "geo_plot.php";

draw_plot_pie();
draw_plot_bar();
draw_plot_scatter();
draw_geo_scatter();
?>
<?php
require_once "water_mark.php";

$images = array("images/plot_pie.png", "images/plot_bar.png", "images/line_plot.png", "images/geo_plot.png");
echo count($images);
foreach ($images as $image) {
    echo "call\n";
    create_water_mark($image);
}
?>
<img src="images/plot_pie.png" alt="plot_1.png">
<img src="images/plot_bar.png" alt="plot_2.png">
<img src="images/line_plot.png" alt="plot_3.png">
<img src="images/geo_plot.png" alt="plot_4.png">
<!--<img src="images/worldmap1.jpg" alt="plot_5.png">-->

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
    $data = get_raw_data();

    foreach ($data as $data_row) {
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
</body>
</html>
