<?php
namespace Augusthur\JsonRespector\Rules;

class ItemsRule implements RuleInterface
{
    protected $tuple;
    protected $extra;
    protected $rules;

    public function __construct($value, $schema, $service, $assoc)
    {
        if (!is_array($value)) {
            throw new \Exception();
        } elseif (array() === $value) {
            $this->tuple = false;
            $this->rules = [$service->start()->alwaysValid()];
        } else {
            $this->tuple = true;
            $this->rules = [];
            $sequentialKeys = range(0, count($value)-1);
            foreach ($sequentialKeys as $i) {
                if (isset($value[$i])) {
                    $this->rules[] = $service->start()->key(
                        $i,
                        $service->fromSchema($value[$i], $assoc),
                        false
                    );
                } else {
                    $this->tuple = false;
                    $this->rules = [$service->fromSchema($value, $assoc)];
                    continue;
                }
            }
        }
        $this->extra = !isset($schema['additionalItems']) || $schema['additionalItems']!==false;
    }

    public function addRules($validator)
    {
        if ($this->tuple) {
            if ($this->extra) {
                return $validator->addRules($this->rules);
            } else {
                return $validator->addRule('keySet', $this->rules);
            }
        } else {
            return $validator->addRule('each', $this->rules);
        }
    }
}
