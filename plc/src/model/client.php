<?php

  class cls_client{
    public $client_seq=0;
    public $name="";
    public $section="";
    public $address="";
    public $tel="";
    public $person="";
    public $email="";
    public $remarks="";


    function setFromRow(){
      $tel = $this->client_seq*0.05;
      return $this->client_seq+$remarks;
    }
  }


?>