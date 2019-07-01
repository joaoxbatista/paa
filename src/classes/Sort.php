<?php

namespace App\classes;

abstract class Sort {

	public $array;
	protected $operations_count;
	protected $time;
	protected $array_size;
	
	public function __construct($array) {
		$this->array = $array;
		$this->operations_count = 0;
		$this->time = 0;
		$this->array_size = count($array);
	}

	public function addCount() {
		$this->operations_count += 1;
	}

	public function setArray($array) {
		$this->array = $array;
		$this->array_size = count($array);
	}

	public function getTime() {
		return $this->time;
	}

	public function getOperationsCount() {
		return $this->operations_count;
	}

	public function log() {
		$start_time = microtime(true);
		$this->order();
		$end_time = microtime(true);
		$this->time = $end_time - $start_time;
		echo "Tamanho do array: {$this->array_size} \n";
		echo "Tempo de execução: {$this->time} segundos \n";
		echo "Tempo de Quantidade de operações: {$this->operations_count} \n"; 
	}
}