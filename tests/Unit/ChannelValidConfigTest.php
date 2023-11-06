<?php

it('should create a channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $result = $websuckit->createChannel('test-channel', 5);

    expect($result)->toBeArray();
    echo json_encode($result);
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});

it('should get or create channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $result = $websuckit->getOrCreateChannel('test-channel');

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});

it('should update a channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $channel = $websuckit->getOrCreateChannel('test-channel');
    $result = $websuckit->updateChannel($channel['data']['id'], 'test-channel', false, 22);

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});

it('should get channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $result = $websuckit->getChannel('test-channel');

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});

it('should delete channel with valid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $channel = $websuckit->getOrCreateChannel('test-channel');
    $result = $websuckit->deleteChannel($channel['data']['id']);

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeNull();
});

it('should not get channels list with invalid config', function () {
    $websuckit = initializeWebsuckitWithValidConfig();
    $result = $websuckit->getChannels("0", "10");

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'data']);
    expect($result['status'])->toBe(200);
    expect($result['data'])->toBeArray();
});