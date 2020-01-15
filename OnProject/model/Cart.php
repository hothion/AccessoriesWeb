<?php

 class Cart{
	public $cart_id;
	public $name;
	public $price;
	public $quantity;
	
	public function __construct($cart_id,$name, $price,$quantity) {
		$this->cart_id = $cart_id;
		$this->name = $name;
    	$this->price = $price;
    	$this->quantity = $quantity;
  	}
  	function getTotal(){
        return ($this->price * $this->quantity)." VND ";
    }
}
?>
