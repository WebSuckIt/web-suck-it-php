<?php

namespace Websuckit\WebsuckitPhp;

class Websuckit
{
    private string $userId;
    private ?string $accessKey;
    private ?string $publicKey;


    private string $baseUrl;
    private string $wssBaseUrl;

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

    public function hello(): string
    {
        return "hello library";
    }
}