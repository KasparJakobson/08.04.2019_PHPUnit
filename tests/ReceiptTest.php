<?php

namespace TDD\Test;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

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
        // Create a variable of an array and the dummy coupon value
        $input = [0, 2, 5, 8];
        $coupon = null;

        // Give the $input variable to the total() method and save the output to a new variable
        $output = $this->Receipt->total($input, $coupon);
        $this->assertEquals(
            15, // Expected value
            $output, // Value returned by total()
            'When summing the total should equal 15' // Message to return in case of error
        );
    }

    public function testTotalAndCoupon()
    {
        // Create a variable of an array and the coupon value
        $input = [0, 2, 5, 8];
        $coupon = 0.20;

        // Execute total() with the array and the additional value of coupon and save to variable
        $output = $this->Receipt->total($input, $coupon);
        $this->assertEquals(
            12,  // Expected value
            $output, // Value returned by total()
            'When summing the total should equal 12' // Message to return in case of error
        );
    }

    public function testTax()
    {
        // Set variables that will be given to tax()
        $inputAmount = 10.00;
        $taxInput = 0.10;

        // Run tax() with the variables and save to $output
        $output = $this->Receipt->tax($inputAmount, $taxInput);
        $this->assertEquals(
            1.00, // expected value
            $output, // Value returned by tax()
            'The tax calculation should equal 1.00' // Message to return in case of error
        );
    }
}