<?php
namespace Augusthur\JsonRespector\Rules;

class MinPropertiesRule extends AbstractLengthRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [$value, null];
    }
}
