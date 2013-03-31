<?php
use Predis\Client;

require_once __DIR__ . '/../vendor/autoload.php';

$redis = new Client();
$redis->set('hello', 'world');
$value = $redis->get('hello');

echo "Hello, $value\n";
