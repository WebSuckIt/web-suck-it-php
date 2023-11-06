<?php

namespace Websuckit\WebsuckitPhp;


trait Channel
{
    use Base;
    private string $resourceName = "channel";

    /**
     * @param string $channel
     * @param int|null $max_connections
     * @return array
     */
    public function createChannel(string $channel, ?int $max_connections = null): array
    {
        $body = [
            "channel"=>$channel
        ];
        if(!is_null($max_connections)){
            $body['max_connections']=$max_connections;
        }
        return $this->request("/{$this->resourceName}/create", "POST", json_encode($body));
    }

    /**
     * @param string $channelId
     * @param string $channel
     * @param bool $regeneratePassKey
     * @param int|null $max_connections
     * @return array
     */
    public function updateChannel(string $channelId, string $channel, bool $regeneratePassKey, ?int $max_connections = null): array
    {
        $body = [
            "channel"=>$channel,
            "regenerate_pass_key"=>$regeneratePassKey,
        ];
        if(!is_null($max_connections)){
            $body['max_connections']=$max_connections;
        }
        return $this->request("/{$this->resourceName}/{$channelId}/update", "PUT", json_encode($body));
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
    public function getChannels(string $page, string $per_page, ?string $search_key = null): array
    {
        $queryParams = [
            "page"=>$page,
            "per_page"=>$per_page,
        ];

        if(!is_null($search_key)){
            $queryParams['search_key']=$search_key;
        }
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