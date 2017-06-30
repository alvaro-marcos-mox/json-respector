<?php
namespace Augusthur\JsonRespector\Rules;

class MaxPropertiesRule extends AbstractLengthRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [null, $value];
    }
}
