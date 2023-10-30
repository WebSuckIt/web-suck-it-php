<?php

namespace Websuckit\WebsuckitPhp;

class Websuckit
{
    use Channel;

    /**
     * @param Config $config
     */
    public function __construct(Config $config) {
        $this->userId = $config->userId;
        $this->accessKey = $config->accessKey;
        $this->publicKey = $config->publicKey;
        $this->baseUrl = $config->baseUrl;
        $this->wssBaseUrl = $config->wssBaseUrl;
    }
}