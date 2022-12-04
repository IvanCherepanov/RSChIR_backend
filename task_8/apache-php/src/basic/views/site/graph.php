<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
    <div style=" display: flex;flex-direction: column;">
<?php
print_r($model[0]);
foreach ($model[0] as $image) {
    echo Html::img(Url::to('http://localhost:8006/'.$image), ['class' => 'pull-left img-responsive']);
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
foreach ($model[1] as $data_row) {
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
