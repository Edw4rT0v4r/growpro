<?php

namespace Growpro\Tests\Exercise\Application;

use Growpro\Exercise\Application\Arrays;
use Growpro\Tests\Base;

class ArraysTest extends Base
{
    private Arrays $arrays;

    protected function setUp(): void
    {
        parent::setUp();

        $this->arrays = new Arrays();
    }

    public function testArrayIsNotSorted(): void
    {
        $actual = [
            ['name' => 'cat', 'age' => 5, 'weight' => 3, 'height' => 24],
            ['name' => 'elephant', 'age' => 10, 'weight' => 10, 'height' => 3100],
        ];

        $this->assertSame($actual, $this->arrays->sortArrayOfArrays($actual));
        $this->assertSame($actual, $this->arrays->sortArrayOfArrays($actual, []));
    }

    public function testArrayIsSorted(): void
    {
        $actual = [
            ['user' => 'Oscar', 'age' => 18, 'scoring' => 40],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];

        $expect = [
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
            ['user' => 'Oscar', 'age' => 18, 'scoring' => 40],
        ];

        $sortCriterion = ['age' => $this->arrays::DESC, 'scoring' => $this->arrays::DESC];

        $this->assertSame($expect, $this->arrays->sortArrayOfArrays($actual, $sortCriterion));
    }

    public function testArrayIsSortedPutAtTheTop(): void
    {
        $actual = [
            ['user' => 'Oscar', 'age' => 20, 'scoring' => 40],
            ['user' => 'Oscar', 'scoring' => 30],
            ['user' => 'Oscar', 'scoring' => 50],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];

        $expect = [
            ['user' => 'Oscar', 'scoring' => 50],
            ['user' => 'Oscar', 'scoring' => 30],
            ['user' => 'Oscar', 'age' => 20, 'scoring' => 40],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
        ];

        $sortCriterion = ['age' => $this->arrays::ASC, 'scoring' => $this->arrays::DESC];

        $this->assertSame($expect, $this->arrays->sortArrayOfArrays($actual, $sortCriterion));
    }

    public function testArrayIsSortedPutAtTheEnd(): void
    {
        $actual = [
            ['user' => 'Oscar', 'age' => 20, 'scoring' => 40],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],
            ['user' => 'Mario', 'age' => 44],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Mario', 'age' => 43],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];

        $expect = [
            ['user' => 'Oscar', 'age' => 20, 'scoring' => 40],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Mario', 'age' => 43],
            ['user' => 'Mario', 'age' => 44],
        ];

        $sortCriteria = ['age' => $this->arrays::ASC, 'scoring' => $this->arrays::DESC];

        $this->assertSame($expect, $this->arrays->sortArrayOfArrays($actual, $sortCriteria));
    }

    public function testArrayIsSortedPutAtTheAndAtTheEnd(): void
    {
        $actual = [
            ['name' => 'elephant', 'weight' => 10, 'height' => 3100],
            ['name' => 'cat', 'age' => 6, 'weight' => 6, 'height' => 24],
            ['name' => 'elephant', 'age' => 15, 'weight' => 10, 'height' => 3100],
            ['name' => 'cat', 'age' => 5, 'weight' => 7, 'height' => 24],
            ['name' => 'elephant', 'weight' => 5, 'height' => 2800],
            ['name' => 'cat', 'weight' => 3, 'height' => 24],
            ['name' => 'elephant', 'age' => 10, 'weight' => 10, 'height' => 3100],
            ['name' => 'cat', 'weight' => 9, 'height' => 20],
            ['name' => 'elephant', 'age' => 10, 'height' => 3100],
            ['name' => 'cat', 'age' => 5, 'height' => 24],
            ['name' => 'elephant', 'age' => 15, 'height' => 3100],
            ['name' => 'cat', 'age' => 6, 'height' => 24],
        ];

        $expect = [
            ['name' => 'elephant', 'weight' => 10, 'height' => 3100],
            ['name' => 'cat', 'weight' => 9, 'height' => 20],
            ['name' => 'elephant', 'weight' => 5, 'height' => 2800],
            ['name' => 'cat', 'weight' => 3, 'height' => 24],
            ['name' => 'cat', 'age' => 5, 'weight' => 7, 'height' => 24],
            ['name' => 'cat', 'age' => 6, 'weight' => 6, 'height' => 24],
            ['name' => 'elephant', 'age' => 10, 'weight' => 10, 'height' => 3100],
            ['name' => 'elephant', 'age' => 15, 'weight' => 10, 'height' => 3100],
            ['name' => 'cat', 'age' => 5, 'height' => 24],
            ['name' => 'cat', 'age' => 6, 'height' => 24],
            ['name' => 'elephant', 'age' => 10, 'height' => 3100],
            ['name' => 'elephant', 'age' => 15, 'height' => 3100],
        ];

        $sortCriteria = ['age' => $this->arrays::ASC, 'weight' => $this->arrays::DESC];

        $this->assertSame($expect, $this->arrays->sortArrayOfArrays($actual, $sortCriteria));
    }
}
