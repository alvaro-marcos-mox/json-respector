<?php
namespace Augusthur\JsonRespector\Rules;

class MaxLengthRule extends AbstractLengthRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [null, $value];
    }
}
