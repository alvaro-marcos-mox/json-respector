<?php
namespace Augusthur\JsonRespector\Rules;

use DateTime;

class FormatRule extends AbstractSimpleRule
{
    public function __construct($value, $schema, $service, $assoc)
    {
        if ($value == 'date-time') {
            $this->rule = 'date';
            $this->args = [DateTime::ATOM];
        } elseif ($value == 'date') {
            $this->rule = 'date';
            $this->args = ['Y-m-d'];
        } elseif ($value == 'time') {
            $this->rule = 'date';
            $this->args = ['H:i:sP'];
        } elseif ($value == 'email') {
            $this->rule = 'email';
            $this->args = [];
        } elseif ($value == 'uri') {
            $this->rule = 'url';
            $this->args = [];
        } elseif ($value == 'ipv4') {
            $this->rule = 'ip';
            $this->args = [FILTER_FLAG_IPV4];
        } elseif ($value == 'ipv6') {
            $this->rule = 'ip';
            $this->args = [FILTER_FLAG_IPV6];
        } else {
            // TODO support all formats
            throw new \Exception();
        }
    }
}
