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
}
