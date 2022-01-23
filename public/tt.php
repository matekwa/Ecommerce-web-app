<?php

class Employees extends Person{
	public $jobTitle;

	public function __construct($jobTitle,$fisrtName,$lastName,$gender='f'){
		return $this->jobTitle = $jobTitle;

		parent::__construct($fisrtName,$lastName,$gender);
	}
}
class Person{
	public $fisrtName;
	public $lastName;
	public $gender;

	public function __construct($fisrtName,$lastName,$gender='f'){
		$this->fisrtName = $fisrtName;
		$this->lastName = $lastName;
		$this->gender = $gender;
	}

	public function sayHello(){
		return "Hello My name is ".$this->fisrtName." ".$this->lastName;
	}

	public function getGender(){
		 return $this->gender;
	}
}

$ronald = new Employees('Engineer','Ronald','matekwa');
echo "\n";
echo $ronald->sayHello();