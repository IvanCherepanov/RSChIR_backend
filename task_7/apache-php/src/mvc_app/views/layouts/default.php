<?php
$themeStyleSheet = 'http://localhost:8006/main.css';
if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
    $themeStyleSheet = 'http://localhost:8006/dark.css';
}
$lang = "ru";
if (!empty($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
    $lang = "en";
}
$favicon = "http://localhost:8006/img/hp.jpg";
if (!empty($_COOKIE['fav']) && $_COOKIE['fav'] == 'witcher') {
    $favicon = "http://localhost:8006/img/witch.jpg";
}
?>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet"
          href="<?php echo $themeStyleSheet; ?>"
          id="theme-link"
    />
    <link rel="icon"
          href="<?php echo $favicon; ?>"
          type="image/x-icon"
          id="fav-link"
    />
</head>
<body>
<?php echo $content; ?>
</body>
</html>
