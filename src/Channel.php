<?php

namespace Websuckit\WebsuckitPhp;


trait Channel
{
    use Base;
    private string $resourceName = "channel";

    /**
     * @param string $channel
     * @return array
     */
    public function createChannel(string $channel): array
    {
        return $this->request("/{$this->resourceName}/create", "POST", json_encode([
            "channel"=>$channel
        ]));
    }

    /**
     * @param string $channelId
     * @param string $channel
     * @param bool $regeneratePassKey
     * @return array
     */
    public function updateChannel(string $channelId, string $channel, bool $regeneratePassKey): array
    {
        return $this->request("/{$this->resourceName}/{$channelId}/update", "PUT", json_encode([
            "channel"=>$channel,
            "regenerate_pass_key"=>$regeneratePassKey
        ]));
    }

    /**
     * @param string $channelName
     * @return array
     */
    public function getChannel(string $channelName): array
    {
        return $this->request("/{$this->resourceName}/{$channelName}/details");
    }

    /**
     * @param string $channelName
     * @return array
     */
    public function getOrCreateChannel(string $channelName): array
    {
        return $this->request("/{$this->resourceName}/{$channelName}/get-or-create");
    }

    /**
     * @param array<string, string> $queryParams
     * @return array
     */
    public function getChannels(array $queryParams): array
    {
        $queryString = http_build_query($queryParams);
        return $this->request("/{$this->resourceName}/lists?{$queryString}");
    }

    /**
     * @param string $channelId
     * @return array
     */
    public function deleteChannel(string $channelId): array
    {
        return $this->request("/{$this->resourceName}/{$channelId}/delete", "DELETE");
    }
}