<?php
namespace Augusthur\JsonRespector\Rules;

class NotRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [$service->fromSchema($value, $assoc)];
        $this->rule = 'not';
    }
}
