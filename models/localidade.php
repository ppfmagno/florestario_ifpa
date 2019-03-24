<?php

class Localidade {
  public $id;
  public $longitude;
  public $latitude;
  public $municipio;
  
  function __construct($id, $longitude, $latitude, $municipio) {
    $this->id = $id;
    $this->longitude = $longitude;
    $this->latitude = $latitude;
    $this->municipio = $municipio;
  }

  public static function newEmpty() {
    $instance = new self(null, null, null, null);
    return $instance;
  }
}

?>