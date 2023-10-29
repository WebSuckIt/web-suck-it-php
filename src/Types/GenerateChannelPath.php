<?php

namespace Websuckit\WebsuckitPhp\Types;

class GenerateChannelPath
{
    public string $publicKey;
    public string $channelName;
    public string $channelPassKey;
    public string $userId;
    public ?bool $replaySelf;

    public function __construct(string $publicKey, string $channelName, string $channelPassKey, string $userId, ?bool $replaySelf = null) {
        $this->publicKey = $publicKey;
        $this->channelName = $channelName;
        $this->channelPassKey = $channelPassKey;
        $this->userId = $userId;
        $this->replaySelf = $replaySelf;
    }

}