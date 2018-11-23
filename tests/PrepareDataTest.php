<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class PrepareDataTest extends TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new ValidatorService();
    }

    public function testRecursion()
    {
        $schema = json_decode('{
            "type": "object",
            "properties": {
                "prop1": {
                    "type": "object",
                    "properties": {
                        "prop11": {
                            "type": "string",
                            "default": "abc"
                        },
                        "prop12": {
                            "type": "integer"
                        }
                    }
                },
                "prop2": {
                    "type": "string"
                }
            },
            "additionalProperties": false
        }', true);
        $data = [
            'prop1' => [
                'prop11' => null,
                'prop12' => null,
            ],
            'prop2' => 'test',
        ];
        $v = $this->validator->fromSchema($schema);
        $preparedData = $this->validator->prepareData($schema, $data, true);
        $this->assertFalse(array_key_exists('prop12', $preparedData['prop1']));
        $this->assertEquals('abc', $preparedData['prop1']['prop11']);
    }

    public function testOnlyAdditionalProps()
    {
        $schema = json_decode('{
            "type": "object",
            "additionalProperties": {
                "type": "integer",
                "default": 1
            }
        }', true);
        $data = [
            'prop1' => '1',
            'prop2' => 2,
            'prop3' => null,
        ];
        $preparedData = $this->validator->prepareData($schema, $data, true);
        $preparedEmptyData = $this->validator->prepareData($schema, [], true);
        $this->assertCount(3, $preparedData);
        $this->assertInternalType('int', $preparedData['prop1']);
        $this->assertArrayHasKey('prop2', $preparedData);
        $this->assertEquals(1, $preparedData['prop3']);
        $this->assertEmpty($preparedEmptyData);
    }

    public function testPropsAndAdditionalProps()
    {
        $schema = json_decode('{
            "type": "object",
            "properties": {
                "prop1": {
                    "type": "string",
                    "default": "abc"
                }
            },
            "additionalProperties": {
                "type": "integer",
                "default": 1
            }
        }', true);
        $data = [
            'prop1' => 'xyz',
            'prop2' => 2,
        ];
        $preparedData = $this->validator->prepareData($schema, $data, true);
        $preparedEmptyData = $this->validator->prepareData($schema, [], true);
        $this->assertCount(2, $preparedData);
        $this->assertEquals('xyz', $preparedData['prop1']);
        $this->assertEquals(2, $preparedData['prop2']);
        $this->assertCount(1, $preparedEmptyData);
        $this->assertEquals('abc', $preparedEmptyData['prop1']);
    }

    public function testAdditionalPropsFalse()
    {
        $schema = json_decode('{
            "type": "object",
            "properties": {
                "prop1": {
                    "type": "string",
                    "default": "abc"
                }
            },
            "additionalProperties": false
        }', true);
        $data = [
            'prop1' => 'xyz',
            'prop2' => 2,
        ];
        $preparedData = $this->validator->prepareData($schema, $data, true);
        $preparedEmptyData = $this->validator->prepareData($schema, [], true);
        $this->assertCount(2, $preparedData);
        $this->assertCount(1, $preparedEmptyData);
    }

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}