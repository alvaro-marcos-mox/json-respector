<?php
namespace Augusthur\JsonRespector\Rules;

class ContainsRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = [
            $service->start()->each($service->start()->not(
                $service->fromSchema($value, $assoc)
            )),
        ];
        $this->rule = 'not';
    }
}
