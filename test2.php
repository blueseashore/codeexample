<?php
$mem = new Memcached();
$mem->addServer('127.0.0.1',11211);
$mem->setOption(Memcached::OPT_COMPRESSION,false);

$val = json_encode(['1']);
$mem->set('val',$val);
$mem->append('val',$val);

print_r($mem->get('val'));