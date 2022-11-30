<?php

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_parsing.php';

function draw_plot_scatter()
{
    // Some data
    $ydata = get_only_data(get_raw_data(),"number");
    //print_r ($ydata);

    // Create the graph. These two calls are always required
    $__width = 1400;
    $__height = 300;
    $graph = new Graph\Graph($__width, $__height, 'auto');
    $graph->SetScale("textlin");

    // Create the linear plot
    $lineplot = new Amenadiel\JpGraph\Plot\LinePlot($ydata);
    $lineplot->SetColor("blue");

    // Add the plot to the graph
    $graph->Add($lineplot);

    // Display the graph
    $graph->Stroke('images/line_plot.png');

}