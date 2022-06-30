<?php
/**
 *
 */
class Index extends MY_Controller {
  function __construct() {
    parent::__construct();
    
  }
 

  public function index() { 
      $this->data['title']  = 'TK Syalendra';  
      $this->data['content'] = 'landing/index';
      $this->template($this->data,'landing');
  }
}

?>
