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

    /**
     * @dataProvider intersectLineWithLineProvider
     */
    public function testIntersectLineWithLine($p1, $p2, $p3, $p4, $expected)
    {
        $a = new Line($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Intersect();
        $this->assertEquals($expected, $res->intersect($a, $b));
    }

    public function intersectLineWithLineProvider()
    {
        return [
            [
                new Point(1, 1),
                new Point(0, 0),
                new Point(3, 7),
                new Point(-1, 5),
                true
            ],
            [
                new Point(1, 1),
                new Point(0, 0),
                new Point(0, 1),
                new Point(1, 2),
                false
            ]
        ];
    }
    /**
     * @dataProvider intersectRectangleWithLineProvider
     */

    public function testIntersectRectangleWithLine($p1, $p2, $p3, $p4, $expected)
    {
        $a = new Rectangle($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Intersect();
        $this->assertEquals($expected, $res->intersect($a, $b));
    }

    public function intersectRectangleWithLineProvider()
    {
        return [
            [
                new Point(-5, -5),
                new Point(5, 5),
                new Point(3, 4),
                new Point(-1, 5),
                true
            ],
            [
                new Point(-5, -5),
                new Point(5, 5),
                new Point(0, -6),
                new Point(1, -6),
                false
            ]
        ];
    }
    /**
     * @dataProvider intersectCircleWithLineProvider
     */

    public function testIntersectCircleWithLine1($p1, $p2, $p3, $r, $expected)
    {
        $a = new Circle($p1, $r);
        $b = new Line($p2, $p3);
        $res = new Intersect();
        $this->assertEquals($expected, $res->intersect($a, $b));
    }

    public function intersectCircleWithLineProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(1, 2),
                new Point(3, 4),
                5,
                true
            ],
            [
                new Point(0, 0),
                new Point(0, -6),
                new Point(1, -6),
                5,
                false
            ]
        ];
    }
    /**
     * @dataProvider intersectRectangleWithRectangleProvider
     */

    public function testIntersectRectangleWithRectangle($p1, $p2, $p3, $p4, $expected)
    {
        $a = new Rectangle($p1, $p2);
        $b = new Rectangle($p3, $p4);
        $res = new Intersect();
        $this->assertEquals($expected, $res->intersect($a, $b));
    }

    public function intersectRectangleWithRectangleProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(2, 3),
                new Point(1, 2),
                new Point(5, 6),
                true
            ],
            [
                new Point(0, 0),
                new Point(2, 3),
                new Point(4, 4),
                new Point(5, 6),
                false
            ],
            [
                new Point(0, 0),
                new Point(1, 1),
                new Point(0, 2),
                new Point(3, 3),
                false
            ]
        ];
    }
    /**
     * @dataProvider intersectCircleWithRectangleProvider
     */

    public function testIntersectCircleWithRectangle($p1, $p2, $p3, $r, $expected)
    {
        $a = new Circle($p1, $r);
        $b = new Rectangle($p2, $p3);
        $res = new Intersect();
        $this->assertEquals($expected, $res->intersect($a, $b));
    }

    public function intersectCircleWithRectangleProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(2, 3),
                new Point(-4, -2),
                5,
                true
            ],
            [
                new Point(0, 0),
                new Point(5, 3),
                new Point(6, 4),
                3,
                false
            ]
        ];
    }

    /**
     * @dataProvider intersectCircleWithCircleProvider
     */
    public function testIntersectCircleWithCircle($p1, $p2, $r1, $r2, $expected)
    {
        $a = new Circle($p1, $r1);
        $b = new Circle($p2, $r2);
        $res = new Intersect();
        $this->assertEquals($expected, $res->intersect($a, $b));
    }

    public function intersectCircleWithCircleProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(5, 3),
                5,
                4,
                true
            ],
            [
                new Point(0, 0),
                new Point(5, 3),
                1,
                2,
                false
            ]
        ];
    }

    /**
     * @dataProvider containsRectangleWithRectangleProvider
     */

    public function testContainsRectangleWithRectangle($p1, $p2, $p3, $p4, $expected)
    {
        $a = new Rectangle($p1, $p2);
        $b = new Rectangle($p3, $p4);
        $res = new Contains();
        $this->assertEquals($expected, $res->contains($a, $b));
    }

    public function containsRectangleWithRectangleProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(5, 3),
                new Point(1, 1),
                new Point(3, 2),
                true
            ],
            [
                new Point(0, 0),
                new Point(5, 3),
                new Point(1, 1),
                new Point(6, 2),
                false
            ]
        ];
    }

    /**
     * @dataProvider containsRectangleWithLineProvider
     */

    public function testContainsRectangleWithLine($p1, $p2, $p3, $p4, $expected)
    {
        $a = new Rectangle($p1, $p2);
        $b = new Line($p3, $p4);
        $res = new Contains();
        $this->assertEquals($expected, $res->contains($a, $b));
    }

    public function containsRectangleWithLineProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(5, 3),
                new Point(1, 1),
                new Point(3, 2),
                true
            ],
            [
                new Point(0, 0),
                new Point(5, 3),
                new Point(1, -1),
                new Point(3, -1),
                false
            ]
        ];
    }

    /**
     * @dataProvider containsRectangleWithCircleProvider
     */

    public function testContainsRectangleWithCircle($p1, $p2, $p3, $r, $expected)
    {
        $a = new Rectangle($p1, $p2);
        $b = new Circle($p3, $r);
        $res = new Contains();
        $this->assertEquals($expected, $res->contains($a, $b));
    }

    public function containsRectangleWithCircleProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(5, 4),
                new Point(1, 2),
                1,
                true
            ],
            [
                new Point(0, 0),
                new Point(5, 4),
                new Point(0, 2),
                4,
                false
            ]
        ];
    }

    /**
     * @dataProvider containsCircleWithLineProvider
     */

    public function testContainsCircleWithLine($p1, $p2, $p3, $r, $expected)
    {
        $a = new Circle($p1, $r);
        $b = new Line($p2, $p3);
        $res = new Contains();
        $this->assertEquals($expected, $res->contains($a, $b));
    }

    public function containsCircleWithLineProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(5, 3),
                new Point(1, 1),
                5,
                true
            ],
            [
                new Point(0, 0),
                new Point(2, -5),
                new Point(1, -5),
                4,
                false
            ]
        ];
    }

    /**
     * @dataProvider containsCircleWithCircleProvider
     */

    public function testContainsCircleWithCircle($p1, $p2, $r1, $r2, $expected)
    {
        $a = new Circle($p1, $r1);
        $b = new Circle($p2, $r2);
        $res = new Contains();
        $this->assertEquals($expected, $res->contains($a, $b));
    }

    public function containsCircleWithCircleProvider()
    {
        return [
            [
                new Point(0, 0),
                new Point(1, 1),
                5,
                2,
                true
            ],
            [
                new Point(1, 0),
                new Point(1, -5),
                1,
                2,
                false
            ]
        ];
    }
}
