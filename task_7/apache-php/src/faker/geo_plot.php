<?php // content="text/plain; charset=utf-8"
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_parsing.php';

DEFINE('WORLDMAP', 'images/worldmap1.png');


function markCallback($y, $x)
{
    // Return array width
    // width,color,fill color, marker filename, imgscale
    // any value can be false, in that case the default value will
    // be used.
    // We only make one pushpin another color
    if ($x == 54)
        return array(false, false, false, 'red', 0.8);
    else
        return array(false, false, false, 'green', 0.8);
}

function draw_geo_scatter()
{

    // Data arrays
        $datax = get_only_data(get_raw_data(),"longitude");//array(10, 20, 30, 40, 54, 60, 70, 80);
        $datay = get_only_data(get_raw_data(),"latitude");//array(12, 23, 65, 18, 84, 28, 86, 44);

    $__width = 400;
    $__height = 270;
    $graph = new Graph\Graph($__width, $__height, 'auto');

    // We add a small 1pixel left,right,bottom margin so the plot area
    // doesn't cover the frame around the graph.
        $graph->img->SetMargin(1, 1, 1, 1);
        $graph->SetScale('linlin', -90, 90, -180, 180);

    // We don't want any axis to be shown
        $graph->xaxis->Hide();
        $graph->yaxis->Hide();

    // Use a worldmap as the background and let it fill the plot area
    $graph->SetBackgroundImage(WORLDMAP, BGIMG_FILLPLOT);

    // Setup a nice title with a striped bevel background
        $graph->title->Set("Pushpin graph");
        $graph->title->SetFont(FF_ARIAL, FS_BOLD, 16);
        $graph->title->SetColor('white');
        $graph->SetTitleBackground('darkgreen', TITLEBKG_STYLE1, TITLEBKG_FRAME_BEVEL);
        $graph->SetTitleBackgroundFillStyle(TITLEBKG_FILLSTYLE_HSTRIPED, 'blue', 'darkgreen');

    // Finally create the scatterplot
        $sp = new Amenadiel\JpGraph\Plot\ScatterPlot($datay, $datax);

    // We want the markers to be an image
        $sp->mark->SetType(MARK_IMG_PUSHPIN, 'blue', 0.6);

    // Install the Y-X callback for the markers
        $sp->mark->SetCallbackYX('markCallback');

    // ...  and add it to the graph
        $graph->Add($sp);

    // .. and output to browser
        $graph->Stroke('images/geo_plot.png');
}

?>