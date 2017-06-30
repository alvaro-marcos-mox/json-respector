<?php
namespace Augusthur\JsonRespector\Rules;

class ExclusiveMinimumRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [$value, false];
        $this->rule = 'min';
    }
}
