<?php
namespace Augusthur\JsonRespector\Rules;

abstract class AbstractSimpleRule implements RuleInterface
{
    protected $args;
    protected $rule;
    
    public function addRules($validator)
    {
        return $validator->addRule($this->rule, $this->args);
    }
}
