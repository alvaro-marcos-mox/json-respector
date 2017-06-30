<?php
namespace Augusthur\JsonRespector\Rules;

class MaxItemsRule extends AbstractLengthRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [null, $value];
    }
}
