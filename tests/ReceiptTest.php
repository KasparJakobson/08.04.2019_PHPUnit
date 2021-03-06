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

    /**
     * @dataProvider provideTotal
     */

    // $items and $expected are passed here from provideTotal which is the dataProvider for this test
    public function testTotal($items, $expected)
    {
        // Create a variable of an array and the dummy coupon value
        $input = [0, 2, 5, 8];
        $coupon = null;

        // Give the $input variable to the total() method and save the output to a new variable
        $output = $this->Receipt->total($items, $coupon);
        $this->assertEquals(
            $expected, // Expected value
            $output, // Value returned by total()
            'When summing the total should equal 15' // Message to return in case of error
        );
    }

    public function provideTotal()
    {
        // Define 2 variables per row that can be passed on to a test
        return [
            [[1, 2, 5, 8], 16],
            [[-1, 2, 5, 8], 14],
            [[1, 2, 8], 11]
        ];
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

    public function testTotalException()
    {
        // Create a variable of an array and the coupon value
        $input = [0,2,5,8];
        $coupon = 1.20;

        // Make the test expect a certain type of exception
        $this->expectException('BadMethodCallException');
        $this->Receipt->total($input, $coupon);
    }

    public function testPostTaxTotal()
    {
        // Create a variable of an array, the tax and a dummy coupon
        $items = [1, 2, 5, 8];
        $tax = 0.20;
        $coupon = null;

        // Create a mock receipt class
        $Receipt = $this->getMockBuilder('TDD\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();

        // Make sure that the total method in mock Receipt will return 10.00
        $Receipt->expects($this->once())// Total assumes it will be called once
        ->method('total')
            ->with($items, $coupon)// Make sure total is called with these values
            ->will($this->returnValue(10.00));

        // Make sure that the tax method in mock Receipt will return 1.00
        $Receipt->expects($this->once())// Tax assumes it will be called once
        ->method('tax')
            ->with(10.00, $tax)// Make sure tax is called with these values
            ->will($this->returnValue(1.00));

        // Execute postTaxTotal with random values
        $result = $Receipt->postTaxTotal([1, 2, 5, 8], 0.20, null);
        $this->assertEquals(
            11.00, // Expected value
            $result // Value returned by postTaxTotal() using mocked values 10.00 and 1.00
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