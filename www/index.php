<?php
namespace App\Geometry;
require_once './init.php';

$p1 = new Point(0, 0);
$p2 = new Point(2, 3);
$p3 = new Point(4, 5);
$p4 = new Point(5, 6);
$a = new Rectangle($p1, $p2);
$b = new Rectangle($p3, $p4);
$res = new Intersect();
var_dump($res->intersect($a, $b));