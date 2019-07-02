<?php

require_once('./vendor/autoload.php');

use App\classes\GnomeSort;
use Tests\ArraysGenerator;

$generator = new ArraysGenerator(999);
// $generator->generate_order_arrays();
// $generator->generate_reverse_arrays();
// $generator->generate_shuffle_arrays();
// $generator->save_arrays();
$generator->open_arrays();


$sorter = new GnomeSort([], "GnomeSort");
$sorter->setArray($generator->order_arrays[1000], "ordenado");
$sorter->log();
$sorter->setArray($generator->reverse_arrays[1000], "reverso");
$sorter->log();
$sorter->setArray($generator->shuffle_arrays[1000], "aleatorio");
$sorter->log();


$sorter->setArray($generator->order_arrays[10000], "ordenado");
$sorter->log();
$sorter->setArray($generator->reverse_arrays[10000], "reverso");
$sorter->log();
$sorter->setArray($generator->shuffle_arrays[10000], "aleatorio");
$sorter->log();

$sorter->setArray($generator->order_arrays[100000], "ordenado");
$sorter->log();
$sorter->setArray($generator->reverse_arrays[100000], "reverso");
$sorter->log();
$sorter->setArray($generator->shuffle_arrays[100000], "aleatorio");
$sorter->log();

$sorter->setArray($generator->order_arrays[1000000], "ordenado");
$sorter->log();
$sorter->setArray($generator->reverse_arrays[1000000], "reverso");
$sorter->log();
$sorter->setArray($generator->shuffle_arrays[1000000], "aleatorio");
$sorter->log();

$sorter->save_log();