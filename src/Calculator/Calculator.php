<?php

namespace Squid\LetMeIn\Calculator;

/**
 * NOTE: Implemented using '...' token to handle variable number of arguments,
 *       thus it will only work on PHP 5.6 or higher versions.
 *
 *       Backwards compatibility can be achieved by replacing '...' token for a
 *       call to func_get_args(), though code will turn less elegant.
 *
 * @author  Marcelo Lipienski <marcelo.lipienski@gmail.com>
 * @version 1.0.0
 */
class Calculator
{

    /**
     * @param mixed $numbers
     * @return int|float Resulting sum of all arguments
     */
    public function sum(...$numbers)
    {
        $this->has_enough_arguments($numbers);

        $total = 0;
        foreach ($numbers as $number) {

            $this->is_valid($number);

            $total += $number;
        }

        return $total;
    }

    /**
     * @param mixed $numbers
     * @return int|float Resulting subtraction of all arguments
     */
    public function subtract(...$numbers)
    {
        $this->has_enough_arguments($numbers);

        foreach ($numbers as $index => $number) {

            $this->is_valid($number);

            if ($index == 0) {
                $total = $number;
            } else {
                $total -= $number;
            }

        }

        return $total;
    }

    /**
     * @param mixed $numbers
     * @return int|float Resulting multiplication of all arguments
     */
    public function multiply(...$numbers)
    {
        $this->has_enough_arguments($numbers);

        // Halts needless calculation if zero is found in arguments list.
        if (array_search(0, $numbers)) {
            return 0;
        }

        $total = 1;

        foreach ($numbers as $number) {

            $this->is_valid($number);

            $total *= $number;
        }

        return $total;
    }

    /**
     * @param mixed $numbers
     * @return int|float Resulting division of all arguments
     */
    public function divide(...$numbers)
    {
        $this->has_enough_arguments($numbers);

        foreach ($numbers as $index => $number) {

            $this->is_valid($number);

            if ($index == 0) {
                $total = $number;
            } else {

                if ($number == 0) {
                    throw new \Exception("You wanna divide by zero? Be careful,
                                  that's how you create black holes");
                }

                $total /= $number;

            }

        }

        return $total;
    }

    /**
     * @param mixed $number
     * @return bool
     * @throws InvalidArgumentException
     */
    protected function is_valid($number)
    {
        if (!is_numeric($number)) {
            throw new \InvalidArgumentException("Dude, I just learned basic
                                              operands. Go easy on me.");
        }

        return true;
    }

    /**
     * @param mixed $args
     * @return bool
     * @throws InvalidArgumentException
     */
    protected function has_enough_arguments($args)
    {
        if (sizeof($args) < 2) {
            $caller = debug_backtrace()[1]['function'];

            throw new \InvalidArgumentException("Sooo..., I should " . $caller . "
                                                  that with what?");
        }

        return true;
    }

}
