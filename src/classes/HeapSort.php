<?php

namespace App\classes;

class HeapSort extends Sort{
	
	public function createHeap($root, $size) {
		$tmp_var = $this->array[$root];
		$left_child = $root * 2 + 1;

		while($left_child <= $size) { // Se o filho da esquerda for menor ou igual ao tamanho do array
			$this->addCount();

			if($left_child < $size) { //Se o filho da esquerda for menor que o tamanho do array
				$this->addCount();				
				
				if($this->array[$left_child] < $this->array[$left_child + 1]) { // Se o filho da esquerda for menor que o da direita, o filho da esquerda vira o da direita
					$this->addCount();
					$left_child = $left_child + 1;
				}
			}


			if($tmp_var < $this->array[$left_child]) { // Se a raiz for menor que o mair valor dos filhos
				$this->addCount();
				$this->array[$root] = $this->array[$left_child]; // Troca o valor do maior filho, que foi colocado anteriormente no left_child, com o valor da raiz

				$root = $left_child; // Troca os indices do maior valor com a raiz

				$left_child = $root * 2 + 1; // Reseta o valor do left_child
			}
			else {
				$left_child = $size + 1; // Faz com que saia do loop
			}
		}

		$this->array[$root] = $tmp_var; // Reseta o valor da raiz
	}

	public function order() {
		$init = (int)floor((count($this->array) - 1) / 2); // Define o ínicie da ordenação como o meio do array
		for($i = $init; $i >= 0; $i--) { // Em quanto $i for mais que 0, sendo que $i começa da metade do array, faça: 
			$this->addCount();
			$count = count($this->array) - 1; // Pega o tamanho do array -1
			$this->createHeap($i, $count); // Realiza a criação dos Heaps
		}

		for($i = (count($this->array)-1); $i >= 1; $i--) { // Pega o tamano do array -1, em quanto $i for maior ou igual a 1
			$this->addCount();
			// Troque os valores do primeiro elememto do array com o último
			$tmp_var = $this->array[0];
			$this->array[0] = $this->array[$i];
			$this->array[$i] = $tmp_var;

			$this->createHeap(0, $i - 1); // Chama a função createHeap passando o tamanho -1
		}

	}



	
}

