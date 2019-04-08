<?php

namespace TDD\Test;
require "vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase
{
    public function setUp()
    {
        // Initialise the receipt object
        $this->Receipt = new Receipt();
    }

    public function tearDown()
    {
        // Delete the receipt object
        unset($this->Receipt);
    }

    public function testTotal()
    {
        // Create a variable of an array
        $input = [0, 2, 5, 8];

        // Give the $input variable to the total() method and save the output to a new variable
        $output = $this->Receipt->total($input);
        $this->assertEquals(
            15, // expected value
            $output, // value returned by total()
            'When summing the total should equal 15' // message to return in case of error
        );
    }
}