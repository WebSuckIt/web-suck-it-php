<?php
require_once 'vendor/autoload.php';
require_once 'loadenv.php';


use Websuckit\WebsuckitPhp\Config;
use Websuckit\WebsuckitPhp\Websuckit;
use \Websuckit\WebsuckitPhp\Types\ChannelConnectionUrlConfig;

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

if(isset($res['data']['id'])){
    $websuckit->updateChannel($res['data']['id'], "another-new", false, 2);
    $websuckit->updateChannel($res['data']['id'], $_ENV['CHANNEL_NAME'], false, 20);
}

$chan = $websuckit->createChannel(generateRandomSlugWithHyphens(2, 8));
if(isset($chan['data']['channel']['id'])){
    echo "\n";
    echo json_encode($websuckit->deleteChannel($chan['data']['channel']['id']));
}
