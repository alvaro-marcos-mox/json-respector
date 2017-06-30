<?php

require __DIR__ . '/../vendor/autoload.php';

$validator = new Augusthur\JsonRespector\ValidatorService();
$v = $validator->fromSchema('{"type": "string","minLength": 1,"maxLength": 3}');
$v->addRule('stringType');

var_dump($v, $v->validate('23754'));
