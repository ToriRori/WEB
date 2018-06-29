<?php
/**
 * Created by PhpStorm.
 * User: Viktoria
 * Date: 17.03.2018
 * Time: 13:49
 */

namespace App\Geometry;


class Intersect
{
    public function intersect(ShapeInterface $a, ShapeInterface $b)
    {
        if ($a instanceof Line && $b instanceof Line)
        {
            return $this->intersectLineWithLine($a, $b);
        }
        if ($a instanceof Rectangle && $b instanceof Rectangle)
        {
            return $this->intersectRectangleWithRectangle($a, $b);
        }
        if ($a instanceof Rectangle && $b instanceof Line)
        {
            return $this->intersectRectangleWithLine($a, $b);
        }
        if ($a instanceof Line && $b instanceof Rectangle)
        {
            return $this->intersectRectangleWithLine($b, $a);
        }
        if ($a instanceof Rectangle && $b instanceof Circle)
        {
            return $this->intersectCircleWithRectangle($b, $a);
        }
        if ($a instanceof Circle && $b instanceof Rectangle)
        {
            return $this->intersectCircleWithRectangle($a, $b);
        }
        if ($a instanceof Circle && $b instanceof Line)
        {
            return $this->intersectCircleWithLine($a, $b);
        }
        if ($a instanceof Line && $b instanceof Circle)
        {
            return $this->intersectCircleWithLine($b, $a);
        }
        if ($a instanceof Circle && $b instanceof Circle)
        {
            return $this->intersectCircleWithCircle($a, $b);
        }
        return false;
    }

    public function intersectLineWithLine(Line $a, Line $b):bool
    {
        if ($a->getRight()->getX() - $a->getLeft()->getX() == 0)
        {
            $k1 = 0;
            $b1 = $a->getLeft()->getY();
        }
        else
        {
            $k1 = ($a->getRight()->getY() - $a->getLeft()->getY())/($a->getRight()->getX() - $a->getLeft()->getX());
            $b1 = $a->getLeft()->getY() - ($a->getRight()->getY() - $a->getLeft()->getY())/($a->getRight()->getX() - $a->getLeft()->getX());
        }
        if ($b->getRight()->getX() - $b->getLeft()->getX() == 0)
        {
            $k2 = 0;
            $b2 = $b->getLeft()->getY();
        }
        else
        {
            $k2 = ($b->getRight()->getY() - $b->getLeft()->getY())/($b->getRight()->getX() - $b->getLeft()->getX());
            $b2 = $b->getLeft()->getY() - ($b->getRight()->getY() - $b->getLeft()->getY())/($b->getRight()->getX() - $b->getLeft()->getX());
        }
        if ($k1 == $k2)
            return false;
        return true;
    }
    public function intersectRectangleWithRectangle(Rectangle $a, Rectangle $b)
    {
        if ((((( $a->getLeft()->getX()>=$b->getLeft()->getX() && $a->getLeft()->getX()<=$b->getRight()->getX() )||( $a->getRight()->getX()>=$b->getLeft()->getX() && $a->getRight()->getX()<=$b->getRight()->getX()  ))
                    && (( $a->getLeft()->getY()>=$b->getLeft()->getY() && $a->getLeft()->getY()<=$b->getRight()->getY() )||( $a->getRight()->getY()>=$b->getLeft()->getY() && $a->getRight()->getY()<=$b->getRight()->getY() )))
                ||
                ((( $b->getLeft()->getX()>=$a->getLeft()->getX() && $b->getLeft()->getX()<=$a->getRight()->getX() )||( $b->getRight()->getX()>=$a->getLeft()->getX() && $b->getRight()->getX()<=$a->getRight()->getX()  ))
                    &&
                    (( $b->getLeft()->getY()>=$a->getLeft()->getY() && $b->getLeft()->getY()<=$a->getRight()->getY() )||( $b->getRight()->getY()>=$a->getLeft()->getY() && $b->getRight()->getY()<=$a->getRight()->getY() ))))
            ||
            (((( $a->getLeft()->getX()>=$b->getLeft()->getX() && $a->getLeft()->getX()<=$b->getRight()->getX() )||( $a->getRight()->getX()>=$b->getLeft()->getX() && $a->getRight()->getX()<=$b->getRight()->getX()  ))
                    && (( $b->getLeft()->getY()>=$a->getLeft()->getY() && $b->getLeft()->getY()<=$a->getRight()->getY() )||( $b->getRight()->getY()>=$a->getLeft()->getY() && $b->getRight()->getY()<=$a->getRight()->getY() )))
                ||
                ((( $b->getLeft()->getX()>=$a->getLeft()->getX() && $b->getLeft()->getX()<=$a->getRight()->getX() )||( $b->getRight()->getX()>=$a->getLeft()->getX() && $b->getRight()->getX()<=$a->getRight()->getX()  ))
                    &&
                    (( $a->getLeft()->getY()>=$b->getLeft()->getY() && $a->getLeft()->getY()<=$b->getRight()->getY() )||( $a->getRight()->getY()>=$b->getLeft()->getY() && $a->getRight()->getY()<=$b->getRight()->getY() )))))
            return true;
        return false;
    }
    public function intersectRectangleWithLine(Rectangle $r, Line $l)
    {
        if ($l->getRight()->getX() - $l->getLeft()->getX() == 0)
        {
            $k = 0;
            $b = $l->getLeft()->getY();
        }
        else
        {
            $k = ($l->getRight()->getY() - $l->getLeft()->getY())/($l->getRight()->getX() - $l->getLeft()->getX());
            $b = $l->getLeft()->getY() - ($l->getRight()->getY() - $l->getLeft()->getY())/($l->getRight()->getX() - $l->getLeft()->getX());
        }
        if (((($k*$r->getLeft()->getX()+$b-$r->getLeft()->getY())*($k*$r->getLeft()->getX()+$b-$r->getRight()->getY())<0))||
        ((($k*$r->getLeft()->getX()+$b-$r->getRight()->getY())*($k*$r->getRight()->getX()+$b-$r->getRight()->getY())<0))||
        ((($k*$r->getRight()->getX()+$b-$r->getRight()->getY())*($k*$r->getRight()->getX()+$b-$r->getLeft()->getY())<0))||
        ((($k*$r->getRight()->getX()+$b-$r->getLeft()->getY())*($k*$r->getLeft()->getX()+$b-$r->getLeft()->getY())<0)))
            return true;
        return false;
    }
    public function intersectCircleWithLine(Circle $c, Line $l)
    {
        if ($l->getRight()->getX() - $l->getLeft()->getX() == 0)
        {
            $k = 0;
            $d = $l->getLeft()->getY();
        }
        else
        {
            $k = ($l->getRight()->getY() - $l->getLeft()->getY())/($l->getRight()->getX() - $l->getLeft()->getX());
            $d = $l->getLeft()->getY() - ($l->getRight()->getY() - $l->getLeft()->getY())/($l->getRight()->getX() - $l->getLeft()->getX());
        }

        $a = 1+$k*$k;
        $b = -2*$c->getCenter()->getX() + 2*$k*$d - 2*$k*$c->getCenter()->getY();
        $z = $c->getCenter()->getX()*$c->getCenter()->getX()+$d*$d+$c->getCenter()->getY()*$c->getCenter()->getY()-$c->getRadius()*$c->getRadius()-2*$d*$c->getCenter()->getY();
        if ($b*$b-4*$a*$z<0)
            return false;
        return true;
    }
    public function intersectCircleWithRectangle(Circle $c, Rectangle $r)
    {
        if(((sqrt(pow($r->getLeft()->getX() - $c->getCenter()->getX(), 2) + pow($r->getLeft()->getY() - $c->getCenter()->getY(), 2)))<=$c->getRadius())||
            ((sqrt(pow($r->getLeft()->getX() - $c->getCenter()->getX(), 2) + pow($r->getRight()->getY() - $c->getCenter()->getY(), 2)))<=$c->getRadius())||
                ((sqrt(pow($r->getRight()->getX() - $c->getCenter()->getX(), 2) + pow($r->getRight()->getY() - $c->getCenter()->getY(), 2)))<=$c->getRadius())||
                    ((sqrt(pow($r->getRight()->getX() - $c->getCenter()->getX(), 2) + pow($r->getLeft()->getY() - $c->getCenter()->getY(), 2)))<=$c->getRadius()))
                        return true;
        return false;
    }
    public function intersectCircleWithCircle(Circle $c1, Circle $c2)
    {
        if ($c1->getCenter()->distance($c2->getCenter()) < $c1->getRadius() + $c2->getRadius())
            return true;
        return false;
    }
}