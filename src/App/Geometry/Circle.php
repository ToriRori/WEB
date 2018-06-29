<?php
namespace App\Geometry;

class Circle implements ShapeInterface {
    /**
     * @var Point
     */
    private $point;
    private $r;

    public function __construct(Point $point, float $r)
    {
        $this->point = $point;
        $this->r = $r;
    }

    public function getName(): string
    {
        return "Circle";
    }

    public function getArea(): float
    {
        return pi()*$this->r*$this->r;
    }

    public function getPerimeter(): float
    {
        return 2*pi()*$this->r;
    }

    public function getCenter(){
        return $this->point;
    }

    public function getRadius(){
        return $this->r;
    }
}