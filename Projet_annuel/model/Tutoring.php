

<?php

class Tutoring{

  protected $category;

  protected $description;

  protected $nbMaxStudents;

  protected $tutor;

  public function __construct($category,$description,$nbMaxStudents){

    $this->category = $category;

    $this->description = $description;

    $this->nbMaxStudents = $nbMaxStudents;

    $this->tutor = $_SESSION['user']->getLogin();

  }

  public function getCategory(){

    return $this->category;

  }

  public function getDescription(){

    return $this->description;

  }

  public function getNbMax(){

    return $this->nbMaxStudents;

  }

  public function getTutor(){

    return $this->tutor;

  }

}

 ?>
