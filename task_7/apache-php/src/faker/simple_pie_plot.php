<?php
require_once '../vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_parsing.php';

function draw_plot_pie()
{
    echo "hello";
    $graph = new Graph\PieGraph(400, 300);
    $graph->title->Set("Century choice");
    $graph->title->SetFont(FF_FONT1, FS_BOLD);
    $graph->SetBox(true);

    $labels_and_values = get_labels_and_values('get_century_count');
    $labels = $labels_and_values["labels"];
    //echo $labels;
    $values = $labels_and_values["values"];
    //echo $values;

    $p1 = new Plot\PiePlot($values);
    $p1->ShowBorder();
    $p1->SetColor('black');
    $p1->SetLabels($labels);

    $graph->Add($p1);
    //echo "what\n";
    $graph->Stroke("images/plot_pie.png");
}