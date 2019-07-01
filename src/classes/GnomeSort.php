<?php

namespace App\classes;

class GnomeSort extends Sort{

	public function order() {
		$index = 0;
		
		while($index < $this->array_size) {

			if($index == 0) {
				$index++;
			}

			if($this->array[$index] >= $this->array[$index - 1]) {
				$index++;
			}

			else {
				$temp = 0;
				$temp = $this->array[$index];
				$this->array[$index] = $this->array[$index - 1];
				$this->array[$index -1] = $temp;
				$index--;
			}
		}	
	}
}