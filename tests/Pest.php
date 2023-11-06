<?php

use Websuckit\WebsuckitPhp\Config;
use Websuckit\WebsuckitPhp\Websuckit;
/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function initializeWebsuckit(): Websuckit
{
    $user_id = "test_user_id";
    $access_key = "access_key";
    $public_key = "-----BEGIN RSA PUBLIC KEY-----
MIIBCgKCAQEA0nvVnQiANN9iJ9g2DWby+XnRLsI4A0LTbbAT8VpHYs0in6p5cY8W
MEX5qzzfp0/G1DaEwE1OTnObCraocovioFSiGlsBKdImXVyqig2j16HQDPsOOigP
7vhJJgGJtDIPoTyxwPgEOlSgTWKHfZzRQGOiEhj0qVhQDc1wtgcnTb/XOn5HkI1t
MLHHHOU4aSf3j0EhYdLAWD2XAEK2uGZbyPQVF3E+Yyh8Hh0ZoQ/DchGCmE6dlNOk
PS6c3nxpjtg6uk1kAfZRqV0yhK+jx+Zmx0nam0f+raB4ARh/PvLczcx0gjzqXfY5
s6lL3she6a8YoGfn/slNQlndoKrVD72zcQIDAQAB
-----END RSA PUBLIC KEY-----";
    $config = new Config($user_id, $access_key, $public_key);
    $websuckit = new Websuckit($config);
    expect($config->baseUrl)->toBe(BASEURL);
    expect($config->wssBaseUrl)->toBe(WSS_BASEURL);
    expect($websuckit)->toBeInstanceOf(Websuckit::class);
    return $websuckit;
}

function initializeWebsuckitWithValidConfig(): Websuckit
{
    $user_id = getenv('USER_ID');
    $access_key = getenv("ACCESS_KEY");
    $public_key = getenv("PUBLIC_KEY");
    echo $user_id;
    echo $access_key;
    echo $public_key;
    expect($user_id)->not->toBeNull();
    expect($access_key)->not->toBeNull();
    expect($public_key)->not->toBeNull();
    $config = new Config($user_id, $access_key, $public_key);
    $websuckit = new Websuckit($config);
    expect($config->baseUrl)->toBe(BASEURL);
    expect($config->wssBaseUrl)->toBe(WSS_BASEURL);
    expect($websuckit)->toBeInstanceOf(Websuckit::class);
    return $websuckit;
}

function initializeInvalidPublicKeyWebsuckit(): Websuckit
{
    $user_id = "test_user_id";
    $access_key = "access_key";
    $public_key = "invalid_key";
    $config = new Config($user_id, $access_key, $public_key);
    $websuckit = new Websuckit($config);
    expect($config->baseUrl)->toBe(BASEURL);
    expect($config->wssBaseUrl)->toBe(WSS_BASEURL);
    expect($websuckit)->toBeInstanceOf(Websuckit::class);
    return $websuckit;
}
