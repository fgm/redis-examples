<?php
use Predis\Client;

require_once __DIR__ . '/../vendor/autoload.php';

$redis = new Client();

$duncan_friends = 'friends:duncan';
$redis->sadd($duncan_friends, 'paul', 'jessica', 'alia');

$leto_friends = 'friends:leto';
$redis->sadd($leto_friends, 'ghanima', 'paul', 'chani', 'jessica');

print_r($redis->smembers($leto_friends));

foreach (array('jessica', 'vladimir') as $name) {
  echo "$name amie de Leto ? "
    . var_export($redis->sismember($leto_friends, $name), TRUE) . "\n";
}

echo "Amis communs de Duncan et Leto: ";
print_r($redis->sinter($leto_friends, $duncan_friends));

$common_friends = 'friends:leto_duncan';
$redis-> sinterstore($common_friends, $leto_friends, $duncan_friends);
echo "Les mêmes, récupérés depuis une clef: ";
print_r($redis->smembers($common_friends));
