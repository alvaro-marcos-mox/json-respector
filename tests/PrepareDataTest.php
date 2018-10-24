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

    public function tearDown()
    {
        // Clean up the test case, called for every defined test
    }
}