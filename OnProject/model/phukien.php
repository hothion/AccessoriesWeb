<?php
require_once "Iphukien.php";
abstract class phukien implements Iphukien{
	public $id;
	public $name;
	public $price;
	public $image;
	public $quantity;
	public function __construct($id,$name, $price, $image,$quantity) {
		$this->id = $id;
		$this->name = $name;
    	$this->price = $price;
    	$this->image = $image;
    	$this->quantity = $quantity;
  	}
}
?>
