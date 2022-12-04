<?php

/** @var yii\web\View $this */
/** @var string $content */
//var_dump(Yii::$app->request->cookies->getValue("fav"));
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

if (Yii::$app->request->cookies->getValue("fav") == 'hp'){
    $fav = '@web/hpa.jpg';
}
else{
    $fav = '@web/witcha.jpg';
}
if (Yii::$app->request->cookies->getValue("lang") == 'en'){
    $lang = 'en-US';
}
else{
    $lang = 'ru';
}
if (Yii::$app->request->cookies->getValue("theme") == 'light'){
    $theme = 'light';
    $text = 'dark';
}
else{
    $theme = 'dark';
    $text = 'light';
}

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias($fav)]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--<html lang="--><?//= Yii::$app->language ?><!--" class="h-100">-->
<html lang="<?= $lang ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100 bg-<?= $theme?> text-'<?= $text?>'">
<?php $this->beginBody() ?>

<header id="header" class="text-'<?= $text?>'">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        //'options' => ['class' => 'navbar-expand-md navbar-light bg-light fixed-top']
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Upload', 'url' => ['/site/upload']],
            ['label' => 'Graph', 'url' => ['/site/graph']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item text-"<?= $text?>"">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout  text-"<?= $text?>"']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container bg-<?= $theme?> text-"<?= $text?>"">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-<?= $theme?>">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
