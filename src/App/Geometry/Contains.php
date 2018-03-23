<?php
/**
 * Created by PhpStorm.
 * User: Viktoria
 * Date: 22.03.2018
 * Time: 23:29
 */

namespace App\Geometry;


class Contains
{
    public function contains(ShapeInterface $a, ShapeInterface $b)
    {
        if ($a instanceof Rectangle && $b instanceof Rectangle)
        {
            return $this->containsRectangleWithRectangle($a, $b);
        }
        if ($a instanceof Rectangle && $b instanceof Line)
        {
            return $this->containsRectangleWithLine($a, $b);
        }
        if ($a instanceof Line && $b instanceof Rectangle)
        {
            return $this->containsRectangleWithLine($b, $a);
        }
        if ($a instanceof Rectangle && $b instanceof Circle)
        {
            return $this->containsCircleWithRectangle($b, $a);
        }
        if ($a instanceof Circle && $b instanceof Rectangle)
        {
            return $this->containsCircleWithRectangle($a, $b);
        }
        if ($a instanceof Circle && $b instanceof Line)
        {
            return $this->containsCircleWithLine($a, $b);
        }
        if ($a instanceof Line && $b instanceof Circle)
        {
            return $this->containsCircleWithLine($b, $a);
        }
        if ($a instanceof Circle && $b instanceof Circle)
        {
            return $this->containsCircleWithCircle($a, $b);
        }
    }

    public function containsRectangleWithRectangle(Rectangle $a, Rectangle $b)
    {
        if ((($a->getLeft()->getX() - $b->getLeft()->getX()) > 0)&&(($a->getLeft()->getY() - $b->getLeft()->getY()) > 0)&&(($b->getRight()->getX()-$a->getRight()->getX()) > 0)&&(($b->getRight()->getY() - $a->getRight()->getY()) > 0))
            return true;
        if ((($a->getLeft()->getX() - $b->getLeft()->getX()) < 0)&&(($a->getLeft()->getY() - $b->getLeft()->getY()) < 0)&&(($b->getRight()->getX()-$a->getRight()->getX()) < 0)&&(($b->getRight()->getY() - $a->getRight()->getY()) < 0))
            return true;
        return false;
    }
    public function containsRectangleWithLine(Rectangle $a, Line $b)
    {
        $res = new Intersect();
        return $res->intersectRectangleWithLine($a, $b);
    }
    public function containsCircleWithRectangle(Circle $a, Rectangle $b)
    {
        if ((pow($b->getLeft()->getX() - $a->getCenter()->getX(), 2)+pow($b->getLeft()->getY() - $a->getCenter()->getY(), 2) < pow($a->getRadius(), 2)) &&
            (pow($b->getLeft()->getX() - $a->getCenter()->getX(), 2)+pow($b->getRight()->getY() - $a->getCenter()->getY(), 2) < pow($a->getRadius(), 2)) &&
            (pow($b->getRight()->getX() - $a->getCenter()->getX(), 2)+pow($b->getLeft()->getY() - $a->getCenter()->getY(), 2) < pow($a->getRadius(), 2)) &&
            (pow($b->getRight()->getX() - $a->getCenter()->getX(), 2)+pow($b->getRight()->getY() - $a->getCenter()->getY(), 2) < pow($a->getRadius(), 2)))
            return true;
        if ((pow($b->getLeft()->getX() - $a->getCenter()->getX(), 2)+pow($b->getLeft()->getY() - $a->getCenter()->getY(), 2) > pow($a->getRadius(), 2)) &&
            (pow($b->getLeft()->getX() - $a->getCenter()->getX(), 2)+pow($b->getRight()->getY() - $a->getCenter()->getY(), 2) > pow($a->getRadius(), 2)) &&
            (pow($b->getRight()->getX() - $a->getCenter()->getX(), 2)+pow($b->getLeft()->getY() - $a->getCenter()->getY(), 2) > pow($a->getRadius(), 2)) &&
            (pow($b->getRight()->getX() - $a->getCenter()->getX(), 2)+pow($b->getRight()->getY() - $a->getCenter()->getY(), 2) > pow($a->getRadius(), 2)))
            return true;
        return false;
    }
    public function containsCircleWithLine(Circle $a, Line $b)
    {
        $res = new Intersect();
        return $res->intersectCircleWithLine($a, $b);
    }
    public function containsCircleWithCircle(Circle $a, Circle $b)
    {
        if ($a->getCenter()->distance($b->getCenter()) + $b->getRadius() <= $a->getRadius())
            return true;
        if ($a->getCenter()->distance($b->getCenter()) + $a->getRadius() <= $b->getRadius())
            return true;
        return false;
    }
}