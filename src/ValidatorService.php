<?php
namespace Augusthur\JsonRespector;

use Augusthur\JsonRespector\Rules\RuleInterface;
use Respect\Validation\Validator;
use ReflectionClass;

class ValidatorService
{
    public function fromSchema($schema, $assoc = true)
    {
        if (!is_array($schema)) {
            $schema = json_decode($schema, true);
        }
        $validator = new Validator();
        foreach ($schema as $keyword => $value) {
            $className = 'Augusthur\\JsonRespector\\Rules\\'.ucfirst($keyword).'Rule';
            if (!class_exists($className)) {
                continue;
            }
            $reflection = new ReflectionClass($className);
            if (!$reflection->isSubclassOf(RuleInterface::class)) {
                throw new Exception();
            }
            $rule = $reflection->newInstanceArgs([$value, $schema, $this, $assoc]);
            $rule->addRules($validator);
        }
        return $validator;
    }

    public function start()
    {
        return new Validator();
    }

    public function prepareData($properties, $data, $deleteNulls = false)
    {
        if (array_key_exists('properties', $properties)) {
            $properties = $properties['properties'];
        }
        if (!is_array($data)) {
            return $data;
        }
        foreach ($properties as $prop => $rules) {
            if (array_key_exists($prop, $data)) {
                if (is_null($data[$prop])) {
                    if ($deleteNulls) {
                        if (array_key_exists('default', $rules)) {
                            $data[$prop] = $rules['default'];
                        } else {
                            unset($data[$prop]);
                        }
                    }
                } elseif (array_key_exists('type', $rules)) {
                    switch ($rules['type']) {
                        case 'integer':
                            $data[$prop] = (int) $data[$prop];
                            break;
                        case 'number':
                            $data[$prop] = (float) $data[$prop];
                            break;
                        case 'string':
                            $data[$prop] = (string) $data[$prop];
                            break;
                        case 'boolean':
                            $data[$prop] = (bool) $data[$prop];
                            break;
                    }
                }
            } elseif (array_key_exists('default', $rules)) {
                $data[$prop] = $rules['default'];
            }
        }
        return $data;
    }
}
