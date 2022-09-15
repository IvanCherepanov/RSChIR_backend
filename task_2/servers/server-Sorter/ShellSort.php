
<?php
include_once 'ConverterString.php';
class ShellSort{
    public static function sort($arr) {
        $arrLen = count($arr);
        $gap = 0;
        while($gap < (int)($arrLen / 3)) {
            $gap = $gap * 3 + 1;
        }

        while ($gap > 0) {
            for($i = $gap; $i < $arrLen; $i++) {
                $j = $i;
                $tmp = $arr[$i];
                while($j >= $gap && $arr[$j - $gap] > $tmp) {
                    $arr[$j] = $arr[$j - $gap];
                    $j = $j - $gap;
                }
                $arr[$j] = $tmp;
            }
            $gap = (int)(($gap - 1) / 3);
        }
        return $arr;
    }

    public static function outputArray($arr){
        foreach($arr as $value)
            echo $value." ";
    }
}

#$arr_old=[-1,3,5,6,3,7,-10];
#print_r(ShellSort::outputArray($arr_old));
#print_r(ShellSort::sort(ConverterString::filterString("1,4,5,6,4.6,3,6,5")));