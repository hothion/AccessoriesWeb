<?php
require_once "phukien.php";

class Xiaomi extends phukien {
	function getType(){
  		return "phu kien";
    }
	function getImagePath(){
  		return "../images/accessories/".$this->image;
  	}
  	function getDisplayPrice(){
  		if($this->name == "Xiaomi"){
  			return ($this->price * 80 / 100)." VND "." (-20%) ";
  		}
		return $this->price." VND";
	}
	function getDisplayOldPrice(){
		if($this->name == "Xiaomi"){
          return $this->price." VND";
    }
    return "";
  }
}
?>