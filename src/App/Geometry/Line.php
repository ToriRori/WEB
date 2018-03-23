<?php
namespace App\Geometry;

class Line implements ShapeInterface {
    private $left, $right;

    public function __construct(Point $left, Point $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    public function getName(): string
    {
        return "Line";
    }

    public function getArea(): float
    {
        return 0;
    }

    public function getPerimeter(): float
    {
        return $this->left->distance($this->right);
    }

    public function getLeft(){
        return $this->left;
    }

    public function getRight(){
        return $this->right;
    }
}