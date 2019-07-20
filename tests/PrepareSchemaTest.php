<?php

use Augusthur\JsonRespector\ValidatorService;
use PHPUnit\Framework\TestCase;

class PrepareSchemaTest extends TestCase
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
                            "type": "string"
                        },
                        "prop12": {
                            "type": "integer"
                        }
                    },
                    "required": ["prop12"],
                    "additionalProperties": false
                },
                "prop2": {
                    "type": "string"
                }
            },
            "required": ["prop1"],
            "additionalProperties": false
        }', true);
        $v2 = $this->validator->fromSchema($schema);
        $v1 = $this->validator->fromSchema($this->validator->prepareSchema($schema));
        $data1 = [
            'prop1' => [
                'prop11' => null,
                'prop12' => 123,
            ],
            'prop2' => null,
        ];
        $data2 = [
            'prop1' => [
                'prop12' => 123,
            ],
        ];
        $this->assertTrue($v1->validate($data1));
        $this->assertTrue($v1->validate($data2));
        $this->assertFalse($v2->validate($data1));
        $this->assertTrue($v2->validate($data2));
    }

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}