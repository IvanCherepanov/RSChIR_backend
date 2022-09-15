<?php
class Decoder{
    // Const for decoding color in RGB format
    // Shift is needed to 256 format
    const RED_COLOR_MASK   = 0b1100000000000000;
    const GREEN_COLOR_MASK = 0b0011000000000000;
    const BLUE_COLOR_MASK  = 0b0000110000000000;

    const SHAPE_MASK       = 0b0000001100000000;
    // Dictionary for decoding shape
    private static $SHAPES_IMAGE = array(
        0b0000000000=>"Circle",
        0b0100000000=>"Rectangle",
        0b1000000000=>"Rounded Rectangle",
        0b1100000000=>"Ellipse"
    );

    // Const for decoding shape primitives
    const WIDTH_MASK       = 0b0000000011110000;
    const HEIGHT_MASK      = 0b0000000000001111;

    private function getParameter(int $number, int $mask): int
    {
        return $number & $mask;
    }

    public function getParameters(int $inputNumber): array
    {
        $shape = self::$SHAPES_IMAGE[$this->getParameter($inputNumber,self::SHAPE_MASK)];
        $height = $this->getParameter($inputNumber, self::HEIGHT_MASK);
        $width = $this->getParameter($inputNumber, self::WIDTH_MASK);
        $blueSaturation = $this->getParameter($inputNumber, self::BLUE_COLOR_MASK)%255;
        $greenSaturation = $this->getParameter($inputNumber, self::GREEN_COLOR_MASK)%255;
        $redSaturation = $this->getParameter($inputNumber, self::RED_COLOR_MASK)%255;
        return [
            "shape" => $shape,
            "height" => $height,
            "width" => $width,
            "blueSaturation"=> $blueSaturation,
            "greenSaturation" => $greenSaturation,
            "redSaturation" => $redSaturation
        ];
    }
}
$person = new Decoder();

#print_r($person->getParameters(27));