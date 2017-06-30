<?php
namespace Augusthur\JsonRespector\Rules;

class PropertiesRule implements RuleInterface
{
    protected $rules;
    protected $extra;

    public function __construct($value, $schema, $service, $assoc)
    {
        if (!is_array($value)) {
            throw new \Exception();
        } elseif (array() === $value) {
            // TODO check
            $this->rules = [$service->start()->alwaysValid()];
            $this->extra = true;
        } else {
            $required = isset($schema['required'])? $schema['required']: [];
            $this->rules = [];
            foreach ($value as $propKey => $propVal) {
                if ($assoc) {
                    $this->rules[] = $service->start()->key(
                        $propKey,
                        $service->fromSchema($propVal, $assoc),
                        in_array($propKey, $required)
                    );
                } else {
                    $this->rules[] = $service->start()->attribute(
                        $propKey,
                        $service->fromSchema($propVal, $assoc),
                        in_array($propKey, $required)
                    );
                }
            }
            $this->extra =
                !isset($schema['additionalProperties'])
                || $schema['additionalProperties']!==false;
        }
    }
    
    public function addRules($validator)
    {
        if ($this->extra) {
            return $validator->addRules($this->rules);
        } else {
            return $validator->addRule('keySet', $this->rules);
        }
    }
}
