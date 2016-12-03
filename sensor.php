<?php

class Sensor {
    public $last_measure;
    public $last_measure_time;
    public $sensor_name;
    public $active;

    public function __construct($fileObject) {
        $this->last_measure = $fileObject->last_measure;
        $this->last_measure_time = $fileObject->last_measure_time;
        $this->sensor_name = $fileObject->sensor_name;
        $this->active = $this->isActive();
    }

    public function isActive() {
        if(time() - $this->last_measure_time > 120) {
            return false;
        } else {
            return true;
        }
    }
}

?>