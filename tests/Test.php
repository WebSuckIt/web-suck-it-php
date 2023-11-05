<?php
require_once '../vendor/autoload.php';
require_once '../loadenv.php';

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
$channel = new ChannelConnectionUrlConfig("another", $_ENV['CHANNEL_PASSKEY'], true);
echo $websuckit->getConnectionUrl($channel);
echo "\n";
$res = $websuckit->getOrCreateChannel("another");

echo json_encode($res);
echo "\n";
echo json_encode($websuckit->getChannel("another"));
echo "\n";
echo json_encode($websuckit->updateChannel($_ENV['TEST_CHANNEL_ID'], "another-new", false));
echo "\n";
$chan = $websuckit->createChannel(generateRandomSlugWithHyphens(2, 8));
echo json_encode($chan);

if(isset($chan['data']['channel']['id'])){
    echo "\n";
    echo json_encode($websuckit->deleteChannel($chan['data']['channel']['id']));
}
