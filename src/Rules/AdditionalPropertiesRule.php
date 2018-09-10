<?php
namespace Augusthur\JsonRespector\Rules;

class AdditionalPropertiesRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        $exclude = isset($schema['properties']) ? $schema['properties'] : [];
        if ($value === false) {
            $this->rule = 'length';
            $this->args = [0, count($exclude)];
        } else {
            $this->args = [
                function ($input) use ($exclude) {
                    return array_diff_key($input, $exclude);
                },
                $service->start()->each($service->fromSchema($value, $assoc)),
            ];
            $this->rule = 'call';
        }
    }
}
