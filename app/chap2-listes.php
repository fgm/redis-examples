<?php
use Predis\Client;

require_once __DIR__ . '/../vendor/autoload.php';

$redis = new Client();
for ($i = 1 ; $i <= 50 ; $i++) {
  $redis->lpush('newusers', "$i");
  $redis->set("user:$i", "user-$i");
}

$redis->lpush('newusers', 'goku');
$redis->set("user:goku", "kwisatz");
$redis->ltrim('newusers', 0, 49);

$keys = $redis->lrange('newusers', 0, 10);
echo "Keys: " . implode(', ', $keys) . "\n";

$get_keys = array_map(function ($i) {
  return "user:$i";
}, $keys);
echo "Get_keys: " . implode(', ', $get_keys) . "\n";

$result = $redis->mGet($get_keys);
echo "Résultat: " . implode(', ', $result) . "\n";

echo "\nLongueur de la liste: " . $redis->llen('newusers') . "\n";
$redis->flushdb();


