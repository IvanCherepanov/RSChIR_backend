<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
$files=\yii\helpers\FileHelper::findFiles('/var/www/html-d/basic/storage/uploads/');
if (isset($files[0])) {
    foreach ($files as $index => $file) {
        $nameFicheiro = substr($file, strrpos($file, '/') + 1);
        //print_r ($nameFicheiro);
        //print_r(Url::base());
        //"basic/storage/uploads/".$nameFicheiro
        echo Html::a($nameFicheiro, Url::to('http://localhost:8006/basic/storage/uploads/'.$nameFicheiro, true) , ['class' => 'btn btn-primary', 'role' => 'modal-remote']) . "<br/>" . "<br/>" ; // render do ficheiro no browser
        //print_r('basic/storage/uploads/'.$nameFicheiro);
    }
} else {
    echo "There are no files available for download.";
}
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'imageFile')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end() ?>

