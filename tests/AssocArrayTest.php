<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class AssocArrayTest extends TestCase
{
    private $validator;

    public function setUp()
    {
      $this->validator = new ValidatorService();
    }

    public function testNoAdditional()
    {
        $schema = '{
            "type": "object",
            "properties": {
                "prop1": {
                    "type": "string"
                }
            },
            "additionalProperties": false
        }';
        $v = $this->validator->fromSchema($schema);
        $this->assertTrue($v->validate([
            'prop1' => 'abc',
        ]));
        $this->assertFalse($v->validate([
            'prop1' => 'abc',
            'prop2' => 'def',
        ]));
    }

    public function testMixed()
    {
        $schema = '{
            "type": "object",
            "properties": {
                "prop1": {
                    "type": "string"
                }
            },
            "additionalProperties": {
                "type": "integer"
            }
        }';
        $v = $this->validator->fromSchema($schema);
        $this->assertTrue($v->validate([
            'prop1' => 'abc',
            'prop2' => 2,
            'prop3' => 24,
        ]));
        $this->assertFalse($v->validate([
            'prop1' => 'abc',
            'mistake' => 'error',
        ]));
    }

    public function testOnlyAdditional()
    {
        $schema = '{
            "type": "object",
            "additionalProperties": {
                "type": "string",
                "format": "email"
            }
        }';
        $v = $this->validator->fromSchema($schema);
        $this->assertTrue($v->validate([
            'prop1' => 'abc@abc.com',
            'prop2' => 'hola@lyris.com.ar',
        ]));
        $this->assertFalse($v->validate([
            'prop1' => 'abc',
            'mistake' => 'error',
        ]));
        $this->assertFalse($v->validate([
            'prop1' => 'abc',
            'prop2' => 'test@test.com',
        ]));
    }

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}