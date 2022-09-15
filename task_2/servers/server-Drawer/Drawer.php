<?php
class Drawer{

    public function draw($shape_parameters){
        #echo $shape_parameters;
        $width = $shape_parameters["width"] + 100;
        $height = $shape_parameters["height"]+100;
        $parameter = ($width>=$height) ? $width/2 : $height/2;  //radius, for example
        $svgOpenTag = '<svg width="'.($width+100).'" height="'.($height+100).'">';
        $svgExitTag = "<'/'svg>";
        $figure="";
        switch($shape_parameters["shape"]){
            case "Circle":
                $figure = "<circle cx='".($width/2)."' cy=".($height/2)." r=".($parameter/2)." fill=rgb(".$shape_parameters["redSaturation"].",".$shape_parameters["greenSaturation"].",".$shape_parameters["blueSaturation"].")>";
                break;
            case "Rectangle":
                $figure = "<rect width='".$width."' height=".$height." fill\
                =rgb(".$shape_parameters["blueSaturation"].",".$shape_parameters["greenSaturation"]."\
                ,".$shape_parameters["redSaturation"].")>";
                break;
            case "Rounded Rectangle":
                $figure ="<rect x=".($width/2)." x=".($height/2)."rx=20 ry=20 width=".$width." height=".$height." fill\
                =rgb(".$shape_parameters["blueSaturation"].",".$shape_parameters["greenSaturation"]."\
                ,".$shape_parameters["redSaturation"].")>";
                break;
            case "Ellipse":
                $figure ="<ellipse cx=".($width/2)." cy=".($height/2)." rx=".($width/2)." ry= ".($height/2)." width=".$width." height=".$height." fill=rgb(".$shape_parameters["redSaturation"].",".$shape_parameters["greenSaturation"].",".$shape_parameters["blueSaturation"].")>";
                break;
            default:
                break;
        }
        echo $svgOpenTag.$figure.$svgExitTag;
    }
}