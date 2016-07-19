<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Entity {

	/**
    * @Assert\NotBlank()
    * @Assert\Email()
    */
	private $field1;


	public function __construct(){


	}

	public function getField1(){
		return $this->field1;
	}

	public function setField1($f1){
		$this->field1 = $f1;
	}
}




?>