<?php

class TutoringBuilder{

  protected $data;

  protected $error;

  public function __construct($data = null){

    if ($data == null) {

			$data = array(

				"category" => "",

				"description" => "",

        "nbMax" => "",

        "tutor" =>"",

			);

		}

    $this->data = $data;

    $this->error = array(

      "category" => "",

      "description" => "",

      "nbMax" => "",

      "tutor" =>"",

    );

  }

  public function getData(){

    return $this->data;

  }

  public function getError(){

    return $this->error;

  }

  public function createTutoring(){

    $tutoring = new Tutoring($this->data["category"],$this->data["description"],$this->data["nbMax"],$this->data["tutor"]);

    return $tutoring;

  }

  public function isValid(){

    $this->error = array(
      "category" => "",
      "description" => "",
      "nbMax" => "",
      "tutor" =>"",
    );

    if (!key_exists("category", $this->data) || $this->data["category"] === ""){
			$this->error["category"] = "Vous devez entrer une catégorie";
    }else if (mb_strlen($this->data["category"], 'UTF-8') >= 30){
			$this->error["category"] = "La catégorie doit faire moins de 30 caractères";
      }

    if(!key_exists("nbMax",$this->data) || $this->data["nbMax"] == ""){
      $this->error["nbMax"] = "Vous devez entrer le nombre maximum de participants";
    }

    foreach ($this->error as $key => $value) {
      if($value != ""){
        return false;
      }
    }

		return true;
  }

}

 ?>
