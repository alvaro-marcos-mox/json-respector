<?php
namespace Augusthur\JsonRespector\Rules;

class UniqueItemsRule implements RuleInterface
{
    protected $unique;

    public function __construct($value, $schema, $service, $assoc)
    {
        $this->unique = $value;
    }

    public function addRules($validator)
    {
        return $this->unique? $validator->addRule('unique'): $validator;
    }
}
