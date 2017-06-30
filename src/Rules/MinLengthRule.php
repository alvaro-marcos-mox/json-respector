<?php
namespace Augusthur\JsonRespector\Rules;

class MinLengthRule extends AbstractLengthRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [$value, null];
    }
}
