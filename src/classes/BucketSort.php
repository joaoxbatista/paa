<?php

namespace App\classes;

class BucketSort extends Sort{
	public function order() {
		$n = sizeof($this->array);
		$buckets = array();
		// Initialize the buckets.
		for ($i = 0; $i < $n; $i++) {
			$buckets[$i] = array();
		}
		// Put each element into matched bucket.
		foreach ($this->array as $el) {
			if(isset($buckets[ceil($el/10)])) {
				array_push($buckets[ceil($el/10)], $el);
			}
		}
		
		// Sort elements in each bucket using insertion sort.
		$j = 0;
		for ($i = 0; $i < $n; $i++)
		{
			// sort only non-empty bucket
			if (!empty($buckets[$i])) {
				$this->insertion_sort($buckets[$i]);
				// Move sorted elements in the bucket into original array.
				foreach ($buckets[$i] as $el) {
					$this->array[$j++] = $el;
				}
			}
		}
	}

	function insertion_sort(&$my_array) {
		if (!is_array($my_array)) return;
		for ($i = 1; $i < sizeof($my_array); $i++) {
			$key = $my_array[$i];
			// This will be $a in comparison function.
			// $key will be the right side element that will be
			// compared against the left sorted elements. For
			// min to max sort, $key should be higher than
			// $elements[0] to $elements[$j]
			$j = $i - 1; // this will be in $b in comparison function
			while ( $j >= 0 && $key < $my_array[$j] ) {
				$my_array[$j + 1] = $my_array[$j];
				$j = $j - 1; // shift right
			}
			$my_array[$j + 1] = $key;
		}
	}


	public function order_count() {
		$n = sizeof($this->array);
		$buckets = array();
		// Initialize the buckets.
		for ($i = 0; $i < $n; $i++) {
			$buckets[$i] = array();
		}
		// Put each element into matched bucket.
		foreach ($this->array as $el) {
			array_push($buckets[ceil($el/10)], $el);
		}
		
		// Sort elements in each bucket using insertion sort.
		$j = 0;
		for ($i = 0; $i < $n; $i++)
		{
			// sort only non-empty bucket
			if (!empty($buckets[$i])) {
				$this->addCount();
				$this->insertion_sort_count($buckets[$i]);
				// Move sorted elements in the bucket into original array.
				foreach ($buckets[$i] as $el) {
					$this->array[$j++] = $el;
					$this->addCount();
				}
			}
		}
	}

	function insertion_sort_count(&$my_array) {
		if (!is_array($my_array)) {
			return;
		}
		for ($i = 1; $i < sizeof($my_array); $i++) {
			$key = $my_array[$i];
			// This will be $a in comparison function.
			// $key will be the right side element that will be
			// compared against the left sorted elements. For
			// min to max sort, $key should be higher than
			// $elements[0] to $elements[$j]
			$j = $i - 1; // this will be in $b in comparison function
			$this->addCount();
			while ( $j >= 0 && $key < $my_array[$j] ) {
				
				$my_array[$j + 1] = $my_array[$j];
				$j = $j - 1; // shift right
				$this->addCount();
			}
			$my_array[$j + 1] = $key;
			$this->addCount();
		}
	}
}


?>