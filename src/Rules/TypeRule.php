<?php
namespace Augusthur\JsonRespector\Rules;

class TypeRule implements RuleInterface
{
    protected $rule;

    public function __construct($value, $schema, $service, $assoc)
    {
        if ($value == 'string') {
            $this->rule = 'stringType';
        } elseif ($value == 'integer') {
            $this->rule = 'intType';
        } elseif ($value == 'number') {
            $this->rule = 'numeric';
        } elseif ($value == 'object') {
            $this->rule = $assoc? 'arrayType': 'objectType';
        } elseif ($value == 'array') {
            // TODO check only numeric keys
            $this->rule = 'arrayType';
        } elseif ($value == 'boolean') {
            $this->rule = 'boolType';
        } elseif ($value == 'null') {
            $this->rule = 'nullType';
        } else {
            throw new \Exception();
        }
    }
    
    public function addRules($validator)
    {
        return $validator->addRule($this->rule);
    }
}
