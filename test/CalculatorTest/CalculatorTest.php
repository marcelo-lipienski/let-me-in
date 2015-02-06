<?php

namespace Squid\LetMeInTests\CalculatorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Squid\LetMeIn\Calculator\Calculator;

/**
 * @author  Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class CalculatorTest extends TestCase
{
    public function setUp()
    {
        if (!class_exists(Calculator::class)) {
            $this->markTestSkipped();
        }
    }

    public function testAddition()
    {
        $result = (new Calculator)->sum(0, 1);

        $this->assertSame(1, $result);
    }

    public function testSubtraction()
    {
        $result = (new Calculator)->subtract(3, 1);

        $this->assertSame(2, $result);
    }

    public function testMultiplication()
    {
        $result = (new Calculator)->multiply(3, 1);

        $this->assertSame(3, $result);
    }

    public function testDivision()
    {
        $result = (new Calculator)->divide(4, 1);

        $this->assertSame(4, $result);
    }

    /**
     * @expectedException Exception
     */
    public function testDivideByZero()
    {
        (new Calculator)->divide(1, 0);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSumInvalidNumber()
    {
        (new Calculator)->sum('a', 'b');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSubtractInvalidNumber()
    {
        (new Calculator)->subtract('a', 'b');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testMultiplyInvalidNumber()
    {
        (new Calculator)->multiply('a', 'b');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDivideInvalidNumber()
    {
        (new Calculator)->divide('a', 'b');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testMustHaveAtLeastTwoNumbersToSum()
    {
        (new Calculator)->sum(1);
    }
}
