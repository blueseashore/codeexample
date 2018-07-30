<?php
/**
 * User: kendo    Date: 2018/3/13
 */
$a = 'hello';
xdebug_debug_zval('a');
$b = &$a;
xdebug_debug_zval('a');
$c = &$a;
$a = NULL;
xdebug_debug_zval('a');
$d = array( 'meaning' => 'life', 'number' => 42 );
xdebug_debug_zval( 'd' );