<?php

it('should not create a channel with invalid config', function () {
    $websuckit = initializeWebsuckit();
    $result = $websuckit->createChannel('MyChannel', 5);

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'message']);
    expect($result['status'])->not()->toBe(200);
    expect($result['status'])->toBe(401);
});

it('should not update a channel with invalid config', function () {
    $websuckit = initializeWebsuckit();
    $result = $websuckit->updateChannel('MyChannelId', 'new-channel', false, 22);

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'message']);
    expect($result['status'])->not()->toBe(200);
    expect($result['status'])->toBe(401);
});

it('should not get channel with invalid config', function () {
    $websuckit = initializeWebsuckit();
    $result = $websuckit->getChannel('channel');

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'message']);
    expect($result['status'])->not()->toBe(200);
    expect($result['status'])->toBe(401);
});

it('should not get or create channel with invalid config', function () {
    $websuckit = initializeWebsuckit();
    $result = $websuckit->getOrCreateChannel('channel');

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'message']);
    expect($result['status'])->not()->toBe(200);
    expect($result['status'])->toBe(401);
});

it('should not delete channel with invalid config', function () {
    $websuckit = initializeWebsuckit();
    $result = $websuckit->deleteChannel('channelID');

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'message']);
    expect($result['status'])->not()->toBe(200);
    expect($result['status'])->toBe(401);
});

it('should not get channels list with invalid config', function () {
    $websuckit = initializeWebsuckit();
    $result = $websuckit->getChannels("0", "10");

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['status', 'message']);
    expect($result['status'])->not()->toBe(200);
    expect($result['status'])->toBe(401);
});