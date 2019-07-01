<?php

require_once('./vendor/autoload.php');

use App\classes\HeapSort;
use App\classes\GnomeSort;

// Teste para o array ordenado
echo "\n\nTestes para: Array ordenado. \n";
$array_100 = range(0, 100 - 1);
$array_1000 = range(0, 1000 - 1);
$array_10000 = range(0, 10000 - 1);
$array_100000 = range(0, 100000 - 1);

$sorter = new HeapSort($array_100);
$sorter->log();
$sorter = new GnomeSort($array_100);
$sorter->log();


$sorter = new HeapSort($array_1000);
$sorter->log();
$sorter = new GnomeSort($array_1000);
$sorter->log();


$sorter = new HeapSort($array_10000);
$sorter->log();
$sorter = new GnomeSort($array_10000);
$sorter->log();


$sorter = new HeapSort($array_100000);
$sorter->log();
$sorter = new GnomeSort($array_100000);
$sorter->log();


// Teste para o array reverso
echo "\n\nTestes para: Array reverso. \n";
$array_100_r = array_reverse($array_100);
$array_1000_r = array_reverse($array_1000);
$array_10000_r = array_reverse($array_10000);
$array_100000_r = array_reverse($array_100000);

$sorter = new HeapSort($array_100_r);
$sorter->log();

$sorter = new HeapSort($array_1000_r);
$sorter->log();

$sorter = new HeapSort($array_10000_r);
$sorter->log();

$sorter = new HeapSort($array_100000_r);
$sorter->log();

// Teste para o array misturado
echo "\n\nTestes para: Array desordenado. \n";
shuffle($array_100);
shuffle($array_1000);
shuffle($array_10000);
shuffle($array_100000);

$sorter = new HeapSort($array_100);
$sorter->log();

$sorter = new HeapSort($array_1000);
$sorter->log();

$sorter = new HeapSort($array_10000);
$sorter->log();

$sorter = new HeapSort($array_100000);
$sorter->log();
