<?php


namespace Tests\Unit\Helpers;


use Tests\TestCase;

class GreatestProduct extends TestCase
{
    public function testFindMethodWithOnlyOneIntegerInInputArray()
    {
        $greatestProduct = new \App\Helpers\GreatestProduct;

        $this->expectException(\InvalidArgumentException::class);
        $greatestProduct->find([1]);
    }

    public function testFindMethodWithStringsInInputArray()
    {
        $greatestProduct = new \App\Helpers\GreatestProduct;

        $this->expectException(\InvalidArgumentException::class);
        $greatestProduct->find(['a', 1, 2]);
    }

    public function testFindMethod()
    {
        $greatestProduct = new \App\Helpers\GreatestProduct;

        $this->assertSame(7*9, $greatestProduct->find([1, 5, 3, 9, 7, 0, 3]));
    }
}
