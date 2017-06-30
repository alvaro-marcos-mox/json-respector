<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class CompositeTest extends TestCase
{
    private $validator;

    public function setUp()
    {
      $this->validator = new ValidatorService();
    }

    public function testAllOf()
    {
        $v = $this->validator->fromSchema('{}');
        $this->assertTrue(true);
        // TODO
    }

    public function testAnyOf()
    {
        $v = $this->validator->fromSchema('{}');
        $this->assertTrue(true);
        // TODO
    }

    public function testOneOf()
    {
        $v = $this->validator->fromSchema('{}');
        $this->assertTrue(true);
        // TODO
    }

    public function testNot()
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
