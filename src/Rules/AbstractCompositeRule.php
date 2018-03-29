<?php
namespace Augusthur\JsonRespector\Rules;

abstract class AbstractCompositeRule implements RuleInterface
{
    protected $args;
    protected $rule;

    public function __construct($value, $schema, $service, $assoc)
    {
        $args = [];
        foreach ($value as $rule) {
            $args[] = $service->fromSchema($rule, $assoc);
        }
        $this->args = $args;
    }
    
    public function addRules($validator)
    {
        return $validator->addRule($this->rule, $this->args);
    }
}
