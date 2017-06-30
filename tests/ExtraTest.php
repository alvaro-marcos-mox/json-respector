<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class ExtraTest extends TestCase
{
    private $validator;

    public function setUp()
    {
      $this->validator = new ValidatorService();
    }

    public function testBoolean()
    {
        $v = $this->validator->fromSchema('{"type": "boolean"}');
        $this->assertFalse($v->validate(''));
        $this->assertFalse($v->validate('true'));
        $this->assertFalse($v->validate(0));
        $this->assertFalse($v->validate(1));
        $this->assertFalse($v->validate([]));
        $this->assertFalse($v->validate(null));
        $this->assertTrue($v->validate(false));
        $this->assertTrue($v->validate(true));
        $v = $this->validator->fromSchema('{"type": "boolean", "const": true}');
        $this->assertFalse($v->validate(false));
        $this->assertTrue($v->validate(true));
    }

    public function testNull()
    {
        $v = $this->validator->fromSchema('{"type": "null"}');
        $this->assertFalse($v->validate(''));
        $this->assertFalse($v->validate('null'));
        $this->assertFalse($v->validate(123));
        $this->assertFalse($v->validate([]));
        $this->assertFalse($v->validate(false));
        $this->assertTrue($v->validate(null));
    }

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}
