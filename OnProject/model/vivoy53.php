<?php
require_once "phukien.php";
class vivoy53 extends phukien {
	function getType(){
		return "phu kien";
	}
	function getImagePath(){
  		return "../images/accessories/".$this->image;
  }
  function getDisplayPrice(){
    if($this->name == "op lung"){
        return ($this->price * 140 / 100)." VND "." (+40%) ";
    }
     return $this->price." VND";;
  }
  function getDisplayOldPrice(){
     if($this->name == "vivo y53"){
        return $this->price." VND";
     }
     return "";
  }
}
?>