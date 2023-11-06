<?php

namespace Websuckit\WebsuckitPhp;
require 'global.php';

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
        $this->baseUrl = $baseUrl ?? BASEURL;
//        $this->baseUrl = $baseUrl ?? DEV_BASEURL;
        $this->wssBaseUrl = $wssBaseUrl ?? WSS_BASEURL;
    }
}