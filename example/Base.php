<?php
require_once 'vendor/autoload.php';
require_once 'loadenv.php';


use Websuckit\WebsuckitPhp\Config;
use Websuckit\WebsuckitPhp\Websuckit;
use \Websuckit\WebsuckitPhp\Types\ChannelConnectionUrlConfig;

$user_id = $_SERVER['USER_ID'];
$access_key = $_SERVER['ACCESS_KEY'];
$public_key = $_SERVER['PUBLIC_KEY'];
$channel_pass_key = $_SERVER['CHANNEL_PASSKEY'];
$channel_name = $_SERVER['CHANNEL_NAME'];

function generateRandomSlugWithHyphens($numWords = 2, $wordLength = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $slug = '';

    for ($i = 0; $i < $numWords; $i++) {
        $word = '';
        for ($j = 0; $j < $wordLength; $j++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $word .= $characters[$randomIndex];
        }
        $slug .= $word;

        if ($i < $numWords - 1) {
            $slug .= '-';
        }
    }

    return $slug;
}

$config = new Config($_ENV['USER_ID'], $_ENV['ACCESS_KEY'], $_ENV['PUBLIC_KEY']);
$websuckit = new Websuckit($config);
$channel = new ChannelConnectionUrlConfig($_ENV['CHANNEL_NAME'], $_ENV['CHANNEL_PASSKEY'], true);
$websuckit->getConnectionUrl($channel);
$res = $websuckit->getOrCreateChannel($_ENV['CHANNEL_NAME']);
$websuckit->getChannel($_ENV['CHANNEL_NAME']);

if(isset($res['data']['channel']['id'])){
    $websuckit->updateChannel($res['data']['channel']['id'], "another-new", false);
    $websuckit->updateChannel($res['data']['channel']['id'], $_ENV['CHANNEL_NAME'], false);
}

$chan = $websuckit->createChannel(generateRandomSlugWithHyphens(2, 8));
if(isset($chan['data']['channel']['id'])){
    echo "\n";
    echo json_encode($websuckit->deleteChannel($chan['data']['channel']['id']));
}
