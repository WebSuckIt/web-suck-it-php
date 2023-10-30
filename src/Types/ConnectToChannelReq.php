<?php

namespace Websuckit\WebsuckitPhp\Types;

class ConnectToChannelReq
{
    public string $channelName;
    public string $channelPassKey;
    public ?bool $replaySelf;

    public function __construct(string $channelName, string $channelPassKey, ?bool $replaySelf = null) {
        $this->channelName = $channelName;
        $this->channelPassKey = $channelPassKey;
        $this->replaySelf = $replaySelf;
    }

}