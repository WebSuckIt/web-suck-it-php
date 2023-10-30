<?php
require_once 'vendor/autoload.php';

use Websuckit\WebsuckitPhp\Config;
use Websuckit\WebsuckitPhp\Websuckit;
use \Websuckit\WebsuckitPhp\Types\ConnectToChannelReq;

$publicKey = "-----BEGIN RSA PUBLIC KEY-----
MIIBCgKCAQEA0nvVnQiANN9iJ9g2DWby+XnRLsI4A0LTbbAT8VpHYs0in6p5cY8W
MEX5qzzfp0/G1DaEwE1OTnObCraocovioFSiGlsBKdImXVyqig2j16HQDPsOOigP
7vhJJgGJtDIPoTyxwPgEOlSgTWKHfZzRQGOiEhj0qVhQDc1wtgcnTb/XOn5HkI1t
MLHHHOU4aSf3j0EhYdLAWD2XAEK2uGZbyPQVF3E+Yyh8Hh0ZoQ/DchGCmE6dlNOk
PS6c3nxpjtg6uk1kAfZRqV0yhK+jx+Zmx0nam0f+raB4ARh/PvLczcx0gjzqXfY5
s6lL3she6a8YoGfn/slNQlndoKrVD72zcQIDAQAB
-----END RSA PUBLIC KEY-----
";

$config = new Config("247dd2d6-5b30-45ad-8351-5c3c40eb0cd3", "tBZ3jHvdv4hzPNJ8QmYV", $publicKey);
$websuckit = new Websuckit($config);
$channel = new ConnectToChannelReq("another", "pu6QFXFFp48ViVUIaEGg", true);
echo $websuckit->getConnectionUrl($channel);
echo "\n";
$res = $websuckit->getOrCreateChannel("another");
echo json_decode($res, true)['pass_key'];