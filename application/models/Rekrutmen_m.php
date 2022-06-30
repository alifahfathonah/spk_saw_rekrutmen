<?php 
class Rekrutmen_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'kd_rekrutmen';
    $this->data['table_name'] = 'rekrutmen';
  }
}

 ?>
