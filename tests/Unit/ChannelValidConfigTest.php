<?php

it('should create a channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $result = $websuckit->createChannel(getenv('CHANNEL_NAME'), 5);

    expect($result)->toBeArray();
    echo json_encode($result);
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});

it('should get or create channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $result = $websuckit->getOrCreateChannel(getenv('CHANNEL_NAME'));

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});

it('should update a channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $channel = $websuckit->getOrCreateChannel(getenv('CHANNEL_NAME'));
    $result = $websuckit->updateChannel($channel['data']['id'], 'test-channel-update', false, 10);

    expect($result)->toBeArray();
    echo json_encode($result);
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});

it('should get channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $result = $websuckit->getChannel('test-channel-update');

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});

it('should delete channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $channel = $websuckit->getOrCreateChannel('test-channel-update');
    $result = $websuckit->deleteChannel($channel['data']['id']);

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeNull();
});

it('should get channels list with invalid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $result = $websuckit->getChannels("0", "10");

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});