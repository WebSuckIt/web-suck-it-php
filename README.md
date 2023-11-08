# web-suck-it-php

[![Test SDK composer package](https://github.com/WebSuckIt/web-suck-it-php/actions/workflows/test.yml/badge.svg)](https://github.com/WebSuckIt/web-suck-it-php/actions/workflows/test.yml)
[![Latest Stable Version](http://poser.pugx.org/websuckit/websuckit-php/v)](https://packagist.org/packages/websuckit/websuckit-php) 
[![Total Downloads](http://poser.pugx.org/websuckit/websuckit-php/downloads)](https://packagist.org/packages/websuckit/websuckit-php) 
[![Latest Unstable Version](http://poser.pugx.org/websuckit/websuckit-php/v/unstable)](https://packagist.org/packages/websuckit/websuckit-php) 
[![License](http://poser.pugx.org/websuckit/websuckit-php/license)](https://packagist.org/packages/websuckit/websuckit-php)
[![PHP Version Require](http://poser.pugx.org/websuckit/websuckit-php/require/php)](https://packagist.org/packages/websuckit/websuckit-php)

For tutorials and more in-depth information about websuckit Channels, visit
our [official docs](https://docs.websuckit.com).


## Usage Overview   

The following topics are covered:
* [Installation](https://github.com/WebSuckIt/web-suck-it-php#installation)
* [Initialization](https://github.com/websuckit/web-suck-it-php#initialization)
* [Channels](https://github.com/WebSuckIt/web-suck-it-php#channel)
    * [Create Channel](https://github.com/WebSuckIt/web-suck-it-php#channel)
    * [Get Channel](https://github.com/WebSuckIt/web-suck-it-php#channel)
    * [Get Channels](https://github.com/WebSuckIt/web-suck-it-php#get-channels-paginated)
    * [Get or Create Channel](https://github.com/WebSuckIt/web-suck-it-php#get-or-create-channel)
    * [Update Channel](https://github.com/WebSuckIt/web-suck-it-php#update-channel)
    * [Delete Channel](https://github.com/WebSuckIt/web-suck-it-php#delete-channel)
    * [Accessing a channel's websocket URL](https://github.com/WebSuckIt/web-suck-it-php#accessing-a-channels-websocket-url)

## Installation

Using composer

```bash
composer require websuckit/websuckit-php
```

## Initialization

```php
require_once 'vendor/autoload.php';

use Websuckit\WebsuckitPhp\Config;
use Websuckit\WebsuckitPhp\Websuckit;

$config = new Config($_ENV['USER_ID'], $_ENV['ACCESS_KEY'], $_ENV['PUBLIC_KEY']);
$websuckit = new Websuckit($config);
```

You can get your `USER_ID`, `ACCESS_KEY` and `PUBLIC_KEY` from the [websuckit dashboard](https://websuckit.com/api-keys).

## Channel

## Accessing a channel's websocket URL

It is possible to access a channel websocket URL by channel name, through the `getConnectionUrl` function

```php
use Websuckit\WebsuckitPhp\Types\ChannelConnectionUrlConfig;

$channel = new ChannelConnectionUrlConfig('CHANNEL-NAME', 'CHANNEL-PASS-KEY', false);
$connection_url = $websuckit->getConnectionUrl($channel);
```

### Create channel

```php
$channel = $websuckit->createChannel('new-channel', 2);
```

### Get channel

```php
$channel = $websuckit->getChannel('CHANNEL-NAME');
```

### Get channels (paginated)

```php
$page = "0";
$per_page = "10";

//search varaible that can be null
$search = "search-term"
$channels = $websuckit->getChannels($page, $per_page, $search);
```

### Get or Create channel

```php
$channel = $websuckit->getOrCreateChannel('CHANNEL-NAME');

```

### Update channel

```php
$channel = $websuckit->updateChannel('CHANNEL-ID', "CHANGE-CHANNEL-NAME", false, 2);
```

### Delete channel

```php
$websuckit->deleteChannel('CHANNEL-ID');
```
