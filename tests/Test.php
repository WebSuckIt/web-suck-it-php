<?php
require_once 'vendor/autoload.php';

use Websuckit\WebsuckitPhp\Config;
use Websuckit\WebsuckitPhp\Websuckit;

$config = new Config("user");
$websuckit = new Websuckit($config);
echo $websuckit->hello();
