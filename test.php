<?php

$list = [
    [
        1, 'xiaohong'
    ],
    [
        2, 'xiaoming'
    ]
];

foreach ($list as [$id, $name]) {
    echo $id, '_', $name, PHP_EOL;
}