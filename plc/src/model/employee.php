<?php

  class testclass_car{
    public $carname="z";
    public $carprise=20000000;

    function carprise_intax(){
      $tax = $this->carprise*0.05;
      return $this->carprise+$tax;
    }
  }


?>