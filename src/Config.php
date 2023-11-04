<?php

namespace Websuckit\WebsuckitPhp;

class Config
{
    public string $userId;
    public ?string $accessKey;
    public ?string $publicKey;
    public string $baseUrl;
    public string $wssBaseUrl;

    /**
     *
     * Initialize the configuration class
     *
     * @param string $userId
     * @param string|null $accessKey
     * @param string|null $publicKey
     * @param string|null $baseUrl
     * @param string|null $wssBaseUrl
     */
    public function __construct(string $userId, ?string $accessKey = null, ?string $publicKey = null, ?string $baseUrl = null, ?string $wssBaseUrl = null) {
        $this->userId = $userId;
        $this->accessKey = $accessKey;
        $this->publicKey = $publicKey;
        $this->baseUrl = $baseUrl ?? "https://backend.websuckit.com/api";
//        $this->baseUrl = $baseUrl ?? "http://127.0.0.1:9999/api";
        $this->wssBaseUrl = $wssBaseUrl ?? "wss://backend.websuckit.com";
    }
}