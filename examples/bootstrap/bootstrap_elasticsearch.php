<?php

require __DIR__.'/bootstrap_general.php';

$client = new Elasticsearch\Client([
    'hosts' => [
        sprintf('%s:%d', $_ENV['ELASTICSEARCH_HOST'], $_ENV['ELASTICSEARCH_PORT'])
    ],
]);

// compiler
$compiler = new \RulerZ\Compiler\Compiler(new \RulerZ\Compiler\EvalEvaluator());

// RulerZ engine
$rulerz = new \RulerZ\RulerZ(
    $compiler, [
        new \RulerZ\Compiler\Target\Elasticsearch\Elasticsearch(),
    ]
);

return [$client, $rulerz];
