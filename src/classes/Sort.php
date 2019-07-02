<?php

namespace App\classes;

abstract class Sort {

	public $array;
	protected $name;
	protected $operations_count;
	protected $time;
	protected $array_size;
	protected $array_type;
	protected $results;

	public function __construct($array = [], $name = "sort") {
		$this->results = [];
		$this->name = $name;
		$this->array = $array;
		$this->operations_count = 0;
		$this->time = 0;
		$this->array_size = count($array);
	}

	public function addCount() {
		$this->operations_count += 1;
	}

	public function setArray($array, $array_type="none") {
		$this->array_type = $array_type;
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
		$this->order_count();
		if($this->name != "") {
			echo "{$this->name}\n";
		}
		echo "Tipo do array: {$this->array_type}\n";
		echo "Tamanho do array: {$this->array_size}\n";
		echo "Tempo de execução: {$this->time} segundos\n";
		echo "Tempo de Quantidade de operações: {$this->operations_count}\n\n"; 

		$result_data = [
			"array_type" => $this->array_type,
			"size_array" => $this->array_size,
			"time" => $this->time,
			"operations_count" => $this->operations_count
		];
		array_push($this->results, $result_data);
	}

	public function save_log($path = "./logs/", $name="log.json") {
		$json_order = json_encode($this->results);
        file_put_contents("{$path}_{$this->name}_{$name}", $json_order);
	}

}