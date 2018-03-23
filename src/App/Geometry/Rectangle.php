<?php
namespace App\Geometry;

class Rectangle implements ShapeInterface {
    private $left, $right;

    public function __construct(Point $left, Point $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    public function getName(): string
    {
        return "Rectangle";
    }

    public function getArea(): float
    {
        return abs($this->left->getX() -$this->right->getX())*abs($this->left->getY()-$this->right->getY());
    }

    public function getPerimeter(): float
    {
        return abs($this->left->getX()-$this->right->getX())*2+abs($this->left->getY()-$this->right->getY())*2;
    }

    public function getLeft(){
        return $this->left;
    }

    public function getRight(){
        return $this->right;
    }
}