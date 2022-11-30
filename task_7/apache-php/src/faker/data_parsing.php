<?php

//  decode from json
function get_raw_data(): array {
    $input = file_get_contents('results.json');
    # echo print_r(json_decode($input));
    return json_decode($input);
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

function get_labels_and_values($func) {
    $raw_data = get_raw_data();

    //use given func to array
    $century_count = $func($raw_data);


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