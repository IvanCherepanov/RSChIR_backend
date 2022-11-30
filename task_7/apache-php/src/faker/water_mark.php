<?php
function create_water_mark($imageEx){
    $image = imagecreatefromstring(file_get_contents($imageEx));
    $stamp = imagecreatefrompng('images/water_mark.png');

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
    echo "tutt\n";
    imagepng($stamp_new,"images/resize_water_mark.png");



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

    imagepng($image, $imageEx);

    ImageDestroy($image);
    ImageDestroy($stamp);
}