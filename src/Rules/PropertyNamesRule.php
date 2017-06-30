<?php
namespace Augusthur\JsonRespector\Rules;

class PropertyNameRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [null, $service->fromSchema($value, $assoc)];
        $this->rule = 'each';
    }
}
