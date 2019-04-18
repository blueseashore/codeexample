<?php
/**
 * User: kendo
 * Date: 2019/3/21
 */
declare(strict_types=1);
require_once '../vendor/autoload.php';

use SilerDiactoros;
use SilerGraphql;
use SilerHttp;

$typeDefs = file_get_contents(__DIR__.'/schema.graphql');
$resolvers = [
    'Query' => [
        'hello' => 'world',
    ],
];
$schema = Graphqlschema($typeDefs, $resolvers);

echo "Server running at http://127.0.0.1:8080";
Httpserver(Graphqlpsr7($schema), function (Throwable $err) {
    var_dump($err);
    return Diactorosjson([
        'error'   => true,
        'message' => $err->getMessage(),
    ]);
})()->run();