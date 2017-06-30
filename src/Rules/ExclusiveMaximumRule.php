<?php
namespace Augusthur\JsonRespector\Rules;

class ExclusiveMaximumRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [$value, false];
        $this->rule = 'max';
    }
}
