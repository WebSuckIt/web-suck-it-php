<?php

namespace Websuckit\WebsuckitPhp;


use Websuckit\WebsuckitPhp\Types\GenerateChannelPath;
use phpseclib3\Crypt\PublicKeyLoader;
use Websuckit\WebsuckitPhp\Types\ConnectToChannelReq;


trait Base
{
    private string $userId;
    private ?string $accessKey;
    private ?string $publicKey;


    private string $baseUrl;
    private string $wssBaseUrl;

    /**
     * @param GenerateChannelPath $path
     * @return \Exception|string
     */
    private function generateChannelPath(GenerateChannelPath $path)
    {
        try {
            $publicKey = $path->publicKey;
            $userId = $path->userId;
            $channelName = $path->channelName;
            $channelPassKey = $path->channelPassKey;
            $replaySelf = $path->replaySelf;

            $replay = isset($replaySelf) ? "&replay_self={$replaySelf}" : "";
            $encodedToken = "user_id={$userId}&channel={$channelName}&channel_pass_key={$channelPassKey}{$replay}";
            $forgePublicKey = PublicKeyLoader::loadPublicKey($publicKey);

            // Encrypt the data
            $encryptedToken = $forgePublicKey->encrypt($encodedToken);

            // Base64 encode the encrypted data with URL-safe characters
            $base64EncodedEncryptedToken = rtrim(strtr(base64_encode($encryptedToken), '+/', '-_'), '=');

            return "{$this->wssBaseUrl}/{$userId}/{$channelName}?encrypted_token={$base64EncodedEncryptedToken}{$replay}";
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * @param ConnectToChannelReq $req
     * @return \Exception|string
     */
    public function getConnectionUrl(ConnectToChannelReq $req) {
        $path = new GenerateChannelPath($this->publicKey, $req->channelName, $req->channelPassKey, $this->userId, $req->replaySelf);
        return $this->generateChannelPath($path);
    }

    /**
     * @param string $endpoint
     * @param string $httpMethod
     * @param string|null $data
     * @return bool|string|void
     */
    protected function request(string $endpoint, string $httpMethod = 'GET', string|null $data = null)
    {
        if(!$this->accessKey) {
            throw new \Error("Accesskey is required in accessing api");
        }

        $url = "{$this->baseUrl}{$endpoint}";

        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Set the HTTP method (GET, POST, PUT, DELETE, etc.)
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $httpMethod);

        // Set custom headers
        $headers = [
            "Content-Type: application/json",
            "x-user-id: {$this->userId}",
            "x-access-key: {$this->accessKey}"
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // Set request data for POST or PUT (optional)
        if ($data !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Check for cURL errors
        if ($response === false) {
            $error = curl_error($curl);
            // Handle the error or log it as needed
            die("cURL error: $error");
        }

        // Close cURL session
        curl_close($curl);

        return $response;
    }
}