

<?php

class Tutoring{

  protected $category;

  protected $description;

  protected $nbMax;

  protected $tutor;

  public function __construct($category,$description,$nbMax,$tutor){

    $this->category = $category;

    $this->description = $description;

    $this->nbMax = $nbMax;

    $this->tutor = $tutor;

  }

  public function getCategory(){

    return $this->category;

  }

  public function getDescription(){

    return $this->description;

  }

  public function getNbMax(){

    return $this->nbMax;

  }

  public function getTutor(){

    return $this->tutor;

  }

}

 ?>
