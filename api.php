<?php
include 'sensor.php';
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getMeasures();
        break;
    case 'POST': 
        addMeasures();
}


function getMeasures() {
    $file = file_get_contents('tempdata.json');
    if($file != '' && $file != 'null') {
        $jsonArray = json_decode($file);
        $sensors = [];
        foreach ($jsonArray as $key) {
            array_push($sensors, new Sensor($key));
        }
        echo json_encode($sensors);
    } else {
        echo '[]';
    }
}

function addMeasures() {
    $json = json_decode(file_get_contents('php://input'));
     $sensor_name = $json->sensor_name;
     $sensor_measure = $json->last_measure;
     $sensor_exists = false;
     $file = file_get_contents('tempdata.json');
     $jsonArray = [];
     if(isset($file) && trim($file)!='' && $file != 'null') {
        $jsonArray = json_decode($file);
        foreach ($jsonArray as $key) {
            if($key->sensor_name == $sensor_name) {
                $key->last_measure = $sensor_measure;
                $key->last_measure_time = time();
                $sensor_exists = true;
                break;
            }
        }
     }
     
    if(!$sensor_exists) {
        $sensor['last_measure'] = $sensor_measure;
        $sensor['last_measure_time'] = time();
        $sensor['sensor_name'] = $sensor_name;
        array_push($jsonArray, (object)$sensor);
    }
    file_put_contents('tempdata.json', json_encode($jsonArray));
    
}