<?php
namespace Augusthur\JsonRespector\Rules;

class ConstRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [$value];
        $this->rule = 'equals';
    }
}
