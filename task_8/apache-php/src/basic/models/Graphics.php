<?php

namespace app\models;

//use Amenadiel\JpGraph\Plot\ScatterPlot;
//use Amenadiel\JpGraph\Plot\ScatterPlot;
use Amenadiel\JpGraph\Graph\Graph;
use Amenadiel\JpGraph\Graph\PieGraph;
use Amenadiel\JpGraph\Plot\BarPlot;
use Amenadiel\JpGraph\Plot\PiePlot;
use Amenadiel\JpGraph\Plot\ScatterPlot;
use yii\base\Model;
use Faker;
//use yii\jpgraph\graph;
//print_r(getcwd());
//use Amenadiel\JpGraph\Plot;
use Faker\Provider\ru_RU;
//DEFINE('WORLDMAP', 'mvc_app/models/images/worldmap1.png');

class Graphics extends Model
{

    public function generateFixtures(){
        $data = array();

        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create();
        // for include russian PersonName
        $faker->addProvider(new \Faker\Provider\ru_RU\Person($faker));
        $faker->addProvider(new \Faker\Provider\ru_RU\Color($faker));

        // generate 50 records for idonotknowwhywedothisthinghelpTask
        for ($i = 0; $i < 50; $i++) {
            $data_row = new Fake_data_item(
                $faker->name(),
                $faker->colorName(),
                $faker->date(),
                $faker->time(),
                $faker->monthName(),
                $faker->century(),
                $faker->countryCode(),
                $faker->randomDigit(),
                $faker->latitude(),
                $faker->longitude()
            );
            $data[] = $data_row;
        }

        #$jsonData = json_encode($data);
        return $data;
    }

    function get_labels_and_values($func) {
        #debug(0);
        $raw_data = $this->generateFixtures();
        ##debug(1);
        //use given func to array
        $century_count = $func($raw_data);
        #debug(2);

        $labels = array_keys($century_count);
        $values = array_values($century_count);
        return array("labels" => $labels, "values" => $values);
    }

    function get_only_data($data, $param){
        $answer = array();
        foreach ($data as $row) {
            $century = $row->$param;
            array_push($answer, $century);
        }
        return $answer;
    }

    function get_century_count($data): array
    {
        $century_count = array();
        foreach ($data as $row) {
            $century = $row->century;
            if(!isset($century_count[$century])) {
                $century_count[$century] = 0;
            }
            $century_count[$century] += 1;
        }
        return $century_count;
    }

    function get_time_type_count($data): array
    {
        $time_type_count = array();
        foreach ($data as $row) {
            $timeType = floatval(substr($row->time, 0, 2));//->format('H');
            if(!isset($time_type_count[$timeType])) {
                $time_type_count[$timeType] = 0;
            }
            $time_type_count[$timeType] += 1;
        }
        return $time_type_count;
    }

    function create_water_mark($imageEx){
        $imageExe = '/var/www/html-d/'.$imageEx;
        $image = imagecreatefromstring(file_get_contents($imageExe));
        $stamp = imagecreatefrompng('/var/www/html-d/basic/views/images/water_mark.png');

        //resize our water_mark
        $stamp_new = imagecreatetruecolor(100,50);
        imagealphablending($stamp_new, false);
        imagesavealpha($stamp_new, true);
        imagecopyresampled(
            $stamp_new,
            $stamp,
            0,
            0,
            0,
            0,
            100,
            50,
            imagesx($stamp),
            imagesy($stamp));
        #echo "tutt\n";
        imagepng($stamp_new,"/var/www/html-d/basic/views/images/resize_water_mark.png");



        //some constant
        $margin = ['right' => 20, 'bottom' => 20]; // Смещение от края
        $watermarkWidth = imagesx($stamp_new);
        $watermarkHeight = imagesy($stamp_new);
        $originalWidth = imagesx($image);
        $originalHeight = imagesy($image);

        $destX = $originalWidth - $watermarkWidth - $margin['right'];
        $destY = $originalHeight - $watermarkHeight -  $margin['bottom'];


        // Задание режима сопряжения цветов для изображения
        // Выключение альфа-смешения
        imagealphablending($stamp_new, false);
        // Установка альфа-флага
        imagesavealpha($stamp_new, true);
        //
        $alpha = 75; // 0-полностью прозначный, 255 - полностью непрозрачный

        for ($x = 0; $x < $watermarkWidth; $x++) {
            for ($y = 0; $y < $watermarkHeight; $y++) {

                // get current color (R, G, B)
                $rgb = imagecolorat($stamp_new, $x, $y);
                $r = ($rgb >> 16) & 0xff;
                $g = ($rgb >> 8) & 0xff;
                $b = $rgb & 0xf;

                // create new color
                $col = imagecolorallocatealpha($stamp_new, $r, $g, $b, $alpha);

                // set pixel with new color
                imagesetpixel($stamp_new, $x, $y, $col);
            }
        }

        // creating a cut resource
        $cut = imagecreatetruecolor($watermarkWidth, $watermarkHeight);

        // copying that section of the background to the cut
        imagecopy($cut, $image, 0, 0, $destX, $destY, $watermarkWidth, $watermarkHeight);

        // placing the watermark now
        imagecopy($cut, $stamp_new, 0, 0, 0, 0, $watermarkWidth, $watermarkHeight);

        // merging both of the images
        imagecopymerge($image, $cut, $destX, $destY, 0, 0, $watermarkWidth, $watermarkHeight, 100);

        imagepng($image, $imageExe);

        ImageDestroy($image);
        ImageDestroy($stamp);
    }

    function draw_plot_scatter()
    {
        // Some data
        $data = $this->generateFixtures();
        $ydata = array();
        foreach ($data as $row) {
            $century = $row->number;
            array_push($ydata, $century);
        }
        //print_r ($ydata);

        // Create the graph. These two calls are always required
        $__width = 1400;
        $__height = 300;
        $graph = new Graph($__width, $__height, 'auto');
        $graph->SetScale("textlin");

        // Create the linear plot
        $lineplot = new \Amenadiel\JpGraph\Plot\LinePlot($ydata);
        $lineplot->SetColor("blue");

        // Add the plot to the graph
        $graph->Add($lineplot);

        // Display the graph
        $graph->Stroke('/var/www/html-d/basic/views/images/line_plot.png');

    }

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
        #$datax = $this->get_only_data($this->generateFixtures(),"longitude");//array(10, 20, 30, 40, 54, 60, 70, 80);
        #$datay = $this->get_only_data($this->generateFixtures(),"latitude");//array(12, 23, 65, 18, 84, 28, 86, 44);

        $data = $this->generateFixtures();
        $datax = array();
        foreach ($data as $row) {
            $century = $row->longitude;
            array_push($datax, $century);
        }
        $datay = array();
        foreach ($data as $row) {
            $century = $row->latitude;
            array_push($datay, $century);
        }
        $__width = 400;
        $__height = 270;
        #var_dump($datax);
        #var_dump($datay);
        //$ads = new Graph\Graph($__width, $__height, 'auto');
        $graph   = new \Amenadiel\JpGraph\Graph\Graph($__width, $__height, 'auto');

        // We add a small 1pixel left,right,bottom margin so the plot area
        // doesn't cover the frame around the graph.
        $graph->img->SetMargin(1, 1, 1, 1);
        $graph->SetScale('linlin', -90, 90, -180, 180);

        // We don't want any axis to be shown
        $graph->xaxis->Hide();
        $graph->yaxis->Hide();

        // Use a worldmap as the background and let it fill the plot area
        $graph->SetBackgroundImage('/var/www/html-d/basic/views/images/worldmap1.png', BGIMG_FILLPLOT);

        // Setup a nice title with a striped bevel background
        $graph->title->Set("Pushpin graph");
        $graph->title->SetFont(FF_ARIAL, FS_BOLD, 16);
        $graph->title->SetColor('white');
        $graph->SetTitleBackground('darkgreen', TITLEBKG_STYLE1, TITLEBKG_FRAME_BEVEL);
        $graph->SetTitleBackgroundFillStyle(TITLEBKG_FILLSTYLE_HSTRIPED, 'blue', 'darkgreen');

        // Finally create the scatterplot
        $sp = new \Amenadiel\JpGraph\Plot\ScatterPlot($datay, $datax);
        //$gfd = new ScatterPlot($datay, $datax);

        // We want the markers to be an image
        $sp->mark->SetType(MARK_IMG_PUSHPIN, 'blue', 0.6);

        // Install the Y-X callback for the markers
        //$sp->mark->SetCallbackYX('markCallback');

        // ...  and add it to the graph
        $graph->Add($sp);
//        $lineplot = new \Amenadiel\JpGraph\Plot\LinePlot($datay);
//        $lineplot->SetColor("blue");
//
//        // Add the plot to the graph
//        $graph->Add($lineplot);
        // .. and output to browser
        //$temp = "images/geo_plot.png";
        #echo "putput";
        $graph->Stroke('/var/www/html-d/basic/views/images/geo_plot.png');
        #echo "a?";
    }

    function draw_plot_pie()
    {
        //echo "hello";
        $graph = new PieGraph(400, 300);
        $graph->title->Set("Century choice");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $graph->SetBox(true);

//        $labels_and_values = $this->get_labels_and_values('get_century_count');
//        $labels = $labels_and_values["labels"];
//        //echo $labels;
//        $values = $labels_and_values["values"];
        $data = $this->generateFixtures();
        $labels1 = $this->get_century_count($data);
        #var_dump($labels_and_values);
        $labels = array_keys($labels1);
        $values = array_values($labels1);
        //echo $values;

        $p1 = new PiePlot($values);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetLabels($labels);

        $graph->Add($p1);
        //echo "what\n";
        $graph->Stroke("/var/www/html-d/basic/views/images/plot_pie.png");
    }

    function draw_plot_bar()
    {
        //echo "bue";
// new Graph\Graph with a drop shadow
        $__width = 400;
        $__height = 300;
        $graph = new Graph($__width, $__height, 'auto');
        #echo "12";
        $graph->SetShadow();
        $graph->title->Set("Blood Type");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);

        #debug(-1);
        #$labels_and_values = $this->get_labels_and_values('get_time_type_count');
        $data = $this->generateFixtures();
        $labels1 = $this->get_time_type_count($data);
        #var_dump($labels_and_values);
        $labels = array_keys($labels1);
        $values = array_values($labels1);

// Some data
        $databary = $values;

// Use a "text" X-scale
        $graph->SetScale('textlin');

// Specify X-labels
        $graph->xaxis->SetTickLabels($labels);

// Set title and subtitle
        //$graph->title->Set($_GET['property']);

// Use built in font
        $graph->title->SetFont(FF_FONT1, FS_BOLD);

// Create the bar plot
        $b1 = new BarPlot($databary);
        //$b1->SetLegend($_GET['property']);

//$b1->SetAbsWidth(6);
//$b1->SetShadow();

// The order the plots are added determines who's ontop
        $graph->Add($b1);

// Finally output the  image
// imagepng($graph->img->img);
        $graph->Stroke('/var/www/html-d/basic/views/images/plot_bar.png');
    }

    function draw(){
        #echo "draw_geo_scatter\n";
        $this->draw_geo_scatter();
        //echo "draw_plot_bar";
        $this->draw_plot_bar();
        $this->draw_plot_pie();
        $this->draw_plot_scatter();
        #echo "do not fall";
        $images = array(
            //"mvc_app/models/images/geo_plot.png",
            "basic/views/images/geo_plot.png",
            "basic/views/images/plot_pie.png",
            "basic/views/images/plot_bar.png",
            "basic/views/images/line_plot.png"

        );
        #echo count($images);
        foreach ($images as $image) {
            #echo "call\n";
            $this->create_water_mark($image);
        }
        #print_r($this->generateFixtures());
        #echo "end";
        return array($images, $this->generateFixtures());
    }
}