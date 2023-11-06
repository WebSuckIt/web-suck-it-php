<?php

use Websuckit\WebsuckitPhp\Config;
use Websuckit\WebsuckitPhp\Types\ChannelConnectionUrlConfig;

it('constructs a config with only required arguments', function () {
    $user_id = "test_user_id";
    $config = new Config($user_id);
    expect($config->userId)->toBe($user_id);
    expect($config->accessKey)->toBeNull();
    expect($config->publicKey)->toBeNull();
    expect($config->baseUrl)->toBe(BASEURL);
    expect($config->wssBaseUrl)->toBe(WSS_BASEURL);
    expect($config)->toBeInstanceOf(Config::class);
});

it('constructs a config with all typed arguments', function () {
    $user_id = "test_user_id";
    $access_key = "access_key";
    $public_key = "public_key";
    $base_url = "base_url";
    $ws_url = "ws_url";
    $config = new Config($user_id, $access_key, $public_key, $base_url, $ws_url);
    expect($config->accessKey)->toBe($access_key);
    expect($config->publicKey)->toBe($public_key);
    expect($config->baseUrl)->toBe($base_url);
    expect($config->wssBaseUrl)->toBe($ws_url);
});

it('constructs a valid websuckit class', function () {
    initializeWebsuckit();
});

it('should generate a valid encrypted connection url', function () {
    $channel_name = "some-name";
    $channel_passkey = "some-passkey";
    $websuckit = initializeWebsuckit();
    $channel = new ChannelConnectionUrlConfig($channel_name, $channel_passkey, true);
    expect($channel->channelName)->toBe($channel_name);
    expect($channel->channelPassKey)->toBe($channel_passkey);
    expect($channel)->toBeInstanceOf(ChannelConnectionUrlConfig::class);
    expect($websuckit->getConnectionUrl($channel))->toBeUrl();
});

it('should throw error when generating an encrypted connection url with invalid public key', function () {
    $channel_name = "some-name";
    $channel_passkey = "some-passkey";
    $websuckit = initializeInvalidPublicKeyWebsuckit();
    $channel = new ChannelConnectionUrlConfig($channel_name, $channel_passkey, true);
    expect($websuckit->getConnectionUrl($channel))->toThrow("");
});
