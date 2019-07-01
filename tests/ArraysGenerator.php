<?php

namespace Tests;

class ArraysGenerator {
    public $max_value_rand;
    public $order_arrays = [
        10 => [],
        100 => [],
        1000 => [],
        10000 => [],
        100000 => [],
    ];

    public $reverse_arrays = [
        10 => [],
        100 => [],
        1000 => [],
        10000 => [],
        100000 => [],
    ];

    public $shuffle_arrays = [
        10 => [],
        100 => [],
        1000 => [],
        10000 => [],
        100000 => [],
    ];


    public function __construct($max_value_rand = 1000) {
        $this->max_value_rand = $max_value_rand;
    }

    public function generate_order_arrays() {
        foreach($this->order_arrays as $key => $array) {
            $this->order_arrays[$key] = range(1, $key);
        }
    }

    public function generate_reverse_arrays() {
        foreach($this->reverse_arrays as $key => $array) {
            $this->reverse_arrays[$key] = range(1, $key);
            array_reverse($this->order_arrays[$key]);
        }
    }

    public function generate_shuffle_arrays() {
        foreach($this->shuffle_arrays as $key => $array) {
            for($i = 0; $i < $key; $i ++) {
                $number = rand(0, $this->max_value_rand);
                array_push($this->shuffle_arrays[$key],$number);
            }
        }
    }

    public function save_arrays($path = "./arrays/", $name="arrays.json") {
        
        $json_order = json_encode($this->order_arrays);
        $json_reverse = json_encode($this->reverse_arrays);
        $json_shuffle = json_encode($this->shuffle_arrays);
        
        file_put_contents("{$path}order_{$name}", $json_order);
        file_put_contents("{$path}reverse_{$name}", $json_reverse);
        file_put_contents("{$path}shuffle_{$name}", $json_shuffle);
        echo "Arrays salvos com sucesso!\nArquivos salvos em:\n-> {$path}order_{$name}\n-> {$path}reverse_{$name}\n-> {$path}shuffle_{$name}\n\n";
    }

    public function open_arrays($path = "./arrays/", $name="arrays.json") {
        
    }
}