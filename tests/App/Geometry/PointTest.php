<?php

namespace AppTest\Geometry;

use App\Geometry\Point;
use App\Geometry\Circle;
use App\Geometry\ShapeInterface;
use App\Geometry\Rectangle;
use App\Geometry\Line;
use App\Geometry\Intersect;
use App\Geometry\Contains;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testGetDistance()
    {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $this->assertEquals(5, $p1->distance($p2));
    }
    public function testIntersectLineWithLine1()
    {
        $p1 = new Point(1, 1);
        $p2 = new Point(0, 0);
        $p3 = new Point(3, 7);
        $p4 = new Point(-1, 5);
        $a = new Line($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Intersect();
        $this->assertEquals(true, $res->intersect($a, $b));
    }
    public function testIntersectLineWithLine2()
    {
        $p1 = new Point(1, 1);
        $p2 = new Point(0, 0);
        $p3 = new Point(0, 1);
        $p4 = new Point(1, 2);
        $a = new Line($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Intersect();
        $this->assertEquals(false, $res->intersect($a, $b));
    }
    public function testIntersectRectangleWithLine1()
    {
        $p1 = new Point(-5, -5);
        $p2 = new Point(5, 5);
        $p3 = new Point(3, 4);
        $p4 = new Point(-1, 5);
        $a = new Rectangle($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Intersect();
        $this->assertEquals(true, $res->intersect($a, $b));
    }
    public function testIntersectRectangleWithLine2()
    {
        $p1 = new Point(-5, -5);
        $p2 = new Point(5, 5);
        $p3 = new Point(0, -6);
        $p4 = new Point(1, -6);
        $a = new Rectangle($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Intersect();
        $this->assertEquals(false, $res->intersect($a, $b));
    }
    public function testIntersectCircleWithLine1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(1, 2);
        $p3 = new Point(3, 4);
        $a = new Circle($p1, 5);
        $b = new Line($p3, $p2);
        $res = new Intersect();
        $this->assertEquals(true, $res->intersect($a, $b));
    }
    public function testIntersectCircleWithLine2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(0, -6);
        $p3 = new Point(1, -6);
        $a = new Circle($p1, 5);
        $b = new Line($p3, $p2);
        $res = new Intersect();
        $this->assertEquals(false, $res->intersect($a, $b));
    }
    public function testIntersectRectangleWithRectangle1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(2, 3);
        $p3 = new Point(1, 2);
        $p4 = new Point(5, 6);
        $a = new Rectangle($p1, $p2);
        $b = new Rectangle($p3, $p4);
        $res = new Intersect();
        $this->assertEquals(true, $res->intersect($a, $b));
    }
    public function testIntersectRectangleWithRectangle2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(2, 3);
        $p3 = new Point(4, 5);
        $p4 = new Point(5, 6);
        $a = new Rectangle($p1, $p2);
        $b = new Rectangle($p3, $p4);
        $res = new Intersect();
        $this->assertEquals(false, $res->intersect($a, $b));
    }
    public function testIntersectCircleWithRectangle1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(2, 3);
        $p3 = new Point(-4, -2);
        $a = new Circle($p1, 5);
        $b = new Rectangle($p2, $p3);
        $res = new Intersect();
        $this->assertEquals(true, $res->intersect($a, $b));
    }
    public function testIntersectCircleWithRectangle2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 3);
        $p3 = new Point(6, 4);
        $a = new Circle($p1, 3);
        $b = new Rectangle($p2, $p3);
        $res = new Intersect();
        $this->assertEquals(false, $res->intersect($a, $b));
    }
    public function testIntersectCircleWithCircle1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 3);
        $a = new Circle($p1, 5);
        $b = new Circle($p2, 4);
        $res = new Intersect();
        $this->assertEquals(true, $res->intersect($a, $b));
    }
    public function testIntersectCircleWithCircle2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 3);
        $a = new Circle($p1, 1);
        $b = new Circle($p2, 2);
        $res = new Intersect();
        $this->assertEquals(false, $res->intersect($a, $b));
    }
    public function testContainsRectangleWithRectangle1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 3);
        $p3 = new Point(1, 1);
        $p4 = new Point(3, 2);
        $a = new Rectangle($p1, $p2);
        $b = new Rectangle($p3, $p4);
        $res = new Contains();
        $this->assertEquals(true, $res->contains($a, $b));
    }
    public function testContainsRectangleWithRectangle2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 3);
        $p3 = new Point(1, 1);
        $p4 = new Point(6, 2);
        $a = new Rectangle($p1, $p2);
        $b = new Rectangle($p3, $p4);
        $res = new Contains();
        $this->assertEquals(false, $res->contains($a, $b));
    }
    public function testContainsRectangleWithLine1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 3);
        $p3 = new Point(1, 1);
        $p4 = new Point(3, 2);
        $a = new Rectangle($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Contains();
        $this->assertEquals(true, $res->contains($a, $b));
    }
    public function testContainsRectangleWithLine2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 3);
        $p3 = new Point(1, -1);
        $p4 = new Point(3, -1);
        $a = new Rectangle($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Contains();
        $this->assertEquals(false, $res->contains($a, $b));
    }
    public function testContainsRectangleWithCircle1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 4);
        $p3 = new Point(1, 2);
        $a = new Rectangle($p1, $p2);
        $b = new Circle($p3, 1);
        $res = new Contains();
        $this->assertEquals(true, $res->contains($a, $b));
    }
    public function testContainsRectangleWithCircle2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 4);
        $p3 = new Point(0, 2);
        $a = new Rectangle($p1, $p2);
        $b = new Circle($p3, 4);
        $res = new Contains();
        $this->assertEquals(false, $res->contains($a, $b));
    }
    public function testContainsCircleWithLine1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(5, 3);
        $p3 = new Point(1, 1);
        $a = new Circle($p1, 5);
        $b = new Line($p2, $p3);
        $res = new Contains();
        $this->assertEquals(true, $res->contains($a, $b));
    }
    public function testContainsCircleWithLine2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(2, -5);
        $p3 = new Point(1, -5);
        $a = new Circle($p1, 4);
        $b = new Line($p2, $p3);
        $res = new Contains();
        $this->assertEquals(false, $res->contains($a, $b));
    }
    public function testContainsCicrleWithCircle1()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(1, 1);
        $a = new Circle($p1, 5);
        $b = new Circle($p2, 2);
        $res = new Contains();
        $this->assertEquals(true, $res->contains($a, $b));
    }
    public function testContainsCicrleWithCircle2()
    {
        $p1 = new Point(0, 0);
        $p2 = new Point(1, 1);
        $a = new Circle($p1, 3);
        $b = new Circle($p2, 2);
        $res = new Contains();
        $this->assertEquals(false, $res->contains($a, $b));
    }
}
