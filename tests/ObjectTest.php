<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class ObjectTest extends TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new ValidatorService();
    }

    public function testType()
    {
        $v = $this->validator->fromSchema('{"type": "object"}');
        $u = $this->validator->fromSchema('{"type": "object"}', false);
        $this->assertFalse($v->validate(''));
        $this->assertFalse($v->validate('Not an object'));
        $this->assertFalse($v->validate(123));
        $this->assertFalse($v->validate(null));
        $this->assertFalse($v->validate(false));
        $this->assertFalse($v->validate(["An", "array", "not", "an", "object"]));
        $this->assertTrue($v->validate([]));
        $json = '{"key": "value", "another_key": "another_value"}';
        $this->assertTrue($v->validate(json_decode($json, true)));
        $this->assertTrue($v->validate(json_decode($json, false)));
    }

    public function testKeys()
    {
        $schema = '{
            "type": "object",
            "properties": {
                "number": { "type": "number" },
                "street_name": { "type": "string" },
                "street_type": { "type": "string",
                    "enum": ["Street", "Avenue", "Boulevard"]
                }
            }
        }';
        $v = $this->validator->fromSchema($schema);
        $u = $this->validator->fromSchema($schema, false);
        $json = '{"number": 1600, "street_name": "Pennsylvania", "street_type": "Avenue"}';
        $this->assertTrue($v->validate(json_decode($json, true)));
        $this->assertTrue($u->validate(json_decode($json)));
        $json = '{"number": "1600", "street_name": "Pennsylvania", "street_type": "Avenue"}';
        $this->assertFalse($v->validate(json_decode($json, true)));
        $this->assertFalse($u->validate(json_decode($json)));
        $json = '{"number": 1600, "street_name": "Pennsylvania"}';
        $this->assertTrue($v->validate(json_decode($json, true)));
        $this->assertTrue($u->validate(json_decode($json)));
        $json = '{
            "number": 1600,
            "street_name": "Pennsylvania",
            "street_type": "Avenue",
            "direction": "NW"
        }';
        $this->assertTrue($v->validate(json_decode($json, true)));
        $this->assertTrue($u->validate(json_decode($json)));
    }

    public function testRequired()
    {
        $schema = '{
            "type": "object",
            "properties": {
                "name":      { "type": "string" },
                "email":     { "type": "string" },
                "address":   { "type": "string" },
                "telephone": { "type": "string" }
            },
            "required": ["name", "email"]
        }';
        $v = $this->validator->fromSchema($schema);
        $u = $this->validator->fromSchema($schema, false);
        $json = '{
            "name": "William Shakespeare",
            "email": "bill@stratford-upon-avon.co.uk"
        }';
        $this->assertTrue($v->validate(json_decode($json, true)));
        $this->assertTrue($u->validate(json_decode($json)));
        $json = '{
            "name": "William Shakespeare",
            "email": "bill@stratford-upon-avon.co.uk",
            "address": "Henley Street, Stratford-upon-Avon, Warwickshire, England",
            "authorship": "in question"
        }';
        $this->assertTrue($v->validate(json_decode($json, true)));
        $this->assertTrue($u->validate(json_decode($json)));
        $json = '{
            "name": "William Shakespeare",
            "address": "Henley Street, Stratford-upon-Avon, Warwickshire, England",
        }';
        $this->assertFalse($v->validate(json_decode($json, true)));
        $this->assertFalse($u->validate(json_decode($json)));
    }

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}