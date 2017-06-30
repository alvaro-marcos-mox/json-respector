<?php
namespace Augusthur\JsonRespector\Rules;

class MaximumRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [$value];
        $this->rule = 'max';
    }
}
