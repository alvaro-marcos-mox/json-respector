<?php
namespace Augusthur\JsonRespector\Rules;

class PatternRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $this->args = ['/'.$value.'/'];
        $this->rule = 'regex';
    }
}
