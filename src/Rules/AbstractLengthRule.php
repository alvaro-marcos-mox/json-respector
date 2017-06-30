<?php
namespace Augusthur\JsonRespector\Rules;

abstract class AbstractLengthRule implements RuleInterface
{
    protected $args;
    
    public function addRules($validator)
    {
        return $validator->addRule('length', $this->args);
    }
}
