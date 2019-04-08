<?php

namespace TDD\Test;
require "vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase
{
    public function testTotal()
    {

        // Initialise the Receipt object
        $Receipt = new Receipt();

        // Test if the total() method returns the expected value of 15
        $this->assertEquals(
            15, // expected value
            $Receipt->total([0, 2, 5, 8]), // actual value returned by method
            'When summing the total should equal 15' // message to return in case of error
        );
    }
}