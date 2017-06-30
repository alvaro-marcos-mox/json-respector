<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    private $validator;

    public function setUp()
    {
      $this->validator = new ValidatorService();
    }

    public function testType()
    {
        $v = $this->validator->fromSchema('{"type": "string"}');
        $this->assertTrue($v->validate(''));
        $this->assertTrue($v->validate('hello'));
        $this->assertFalse($v->validate(123));
        $this->assertFalse($v->validate([]));
        $this->assertFalse($v->validate(null));
        $this->assertFalse($v->validate(false));
    }

    public function testGenerics()
    {
        $v = $this->validator->fromSchema('{"type": "string", "const": "foo"}');
        $this->assertTrue($v->validate('foo'));
        $this->assertFalse($v->validate('bar'));
        $v = $this->validator->fromSchema('{"type": "string", "enum": ["foo", "bar"]}');
        $this->assertTrue($v->validate('foo'));
        $this->assertTrue($v->validate('bar'));
        $this->assertFalse($v->validate('baz'));
    }

    public function testLength()
    {
        $schema = [
            'type' => 'string',
            'minLength' => 3,
        ];
        $v = $this->validator->fromSchema($schema);
        $this->assertFalse($v->validate('ab'));
        $this->assertTrue($v->validate('abcdefghijklmñopqrstuvwxyz'));
        $schema['maxLength'] = 7;
        $v = $this->validator->fromSchema($schema);
        $this->assertFalse($v->validate(''));
        $this->assertTrue($v->validate('abc'));
        $this->assertTrue($v->validate('abcde'));
        $this->assertTrue($v->validate('abcdefg'));
        $this->assertFalse($v->validate('ABcdEFgh'));
        unset($schema['minLength']);
        $v = $this->validator->fromSchema($schema);
        $this->assertTrue($v->validate(''));
        $this->assertTrue($v->validate('&%$'));
        $this->assertFalse($v->validate('abcdefghijklmñopqrstuvwxyz'));
    }

    public function testPattern() {
        $schema = [
            'type' => 'string',
            'pattern' => '^(\\([0-9]{3}\\))?[0-9]{3}-[0-9]{4}$',
        ];
        $v = $this->validator->fromSchema($schema);
        $this->assertTrue($v->validate('555-1212'));
        $this->assertTrue($v->validate('(888)555-1212'));
        $this->assertFalse($v->validate('(888)555-1212 ext. 532'));
        $this->assertFalse($v->validate('(800)FLOWERS'));
    }

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}
