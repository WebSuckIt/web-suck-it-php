<?php

namespace Websuckit\WebsuckitPhp;


trait Channel
{
    use Base;
    private string $resourceName = "channel";

    /**
     * @param array<string, string> $data
     * @return bool|string|null
     */
    public function createChannel(array $data): bool|string|null
    {
        return $this->request("/{$this->resourceName}/create", "POST", json_encode($data));
    }

    /**
     * @param array<string, string> $data
     * @return bool|string|null
     */
    public function updateChannel(array $data): bool|string|null
    {
        return $this->request("/{$this->resourceName}/update", "PUT", json_encode($data));
    }

    /**
     * @param string $channelName
     * @return bool|string|null
     */
    public function getChannel(string $channelName): bool|string|null
    {
        return $this->request("/{$this->resourceName}/{$channelName}/details");
    }

    /**
     * @param string $channelName
     * @return bool|string|null
     */
    public function getOrCreateChannel(string $channelName): bool|string|null
    {
        return $this->request("/{$this->resourceName}/{$channelName}/get-or-create");
    }

    /**
     * @param array<string, string> $queryParams
     * @return bool|string|null
     */
    public function getChannels(array $queryParams): bool|string|null
    {
        $queryString = http_build_query($queryParams);
        return $this->request("/{$this->resourceName}/lists?{$queryString}");
    }

    /**
     * @param string $channelId
     * @return bool|string|null
     */
    public function deleteChannel(string $channelId): bool|string|null
    {
        return $this->request("/{$this->resourceName}/{$channelId}/delete", "DELETE");
    }
}