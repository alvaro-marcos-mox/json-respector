<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new ValidatorService();
    }

    public function testType()
    {
        $v = $this->validator->fromSchema('{"type": "array"}');
        $this->assertFalse($v->validate(''));
        $this->assertFalse($v->validate('Not an object'));
        $this->assertFalse($v->validate(123));
        $this->assertFalse($v->validate(null));
        $this->assertFalse($v->validate(false));
        $this->assertFalse($v->validate(['not' => 'an array']));
        $this->assertTrue($v->validate([]));
        $this->assertTrue($v->validate([1, 2, 3, 4, 5]));
        $json = '[3, "different", {"types": "of values"}]';
        $this->assertTrue($v->validate(json_decode($json, true)));
    }

    public function testItems()
    {
        $schema = [
            'type' => 'array',
            'items' => [
                'type' => 'number',
            ],
        ];
        $v = $this->validator->fromSchema($schema);
        $this->assertFalse($v->validate([1, 2, '3', 4, 5]));
        $this->assertTrue($v->validate([1, 2, 3, 4, 5]));
        $this->assertTrue($v->validate([]));
    }

    public function testLength()
    {
        $schema = '{
            "type": "array",
            "minItems": 2,
            "maxItems": 3
        }';
        $v = $this->validator->fromSchema($schema);
        $this->assertFalse($v->validate([]));
        $this->assertFalse($v->validate([1]));
        $this->assertTrue($v->validate([1, 2]));
        $this->assertTrue($v->validate([1, 2, 3]));
        $this->assertFalse($v->validate([1, 2, 3, 4]));
    }

    public function testContains()
    {
        $schema = [
            'type' => 'array',
            'contains' => [
                'type' => 'integer',
            ],
        ];
        $v = $this->validator->fromSchema($schema);
        $this->assertTrue($v->validate([1, 'one', 2]));
        $this->assertTrue($v->validate([1, 2, 3, 4]));
        $this->assertFalse($v->validate(['one', 'two']));
    }

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}