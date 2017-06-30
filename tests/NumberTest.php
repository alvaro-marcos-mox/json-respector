<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    private $validator;

    public function setUp()
    {
      $this->validator = new ValidatorService();
    }

    public function testType()
    {
        $v = $this->validator->fromSchema('{}');
        $this->assertTrue(true);
        // TODO
    }

    public function testMultipleOf()
    {
        $v = $this->validator->fromSchema('{}');
        $this->assertTrue(true);
        // TODO
    }

    public function testRange()
    {
        $v = $this->validator->fromSchema('{}');
        $this->assertTrue(true);
        // TODO
    }

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}
