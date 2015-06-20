<?php

namespace ForecastTools\Test\Cache;

use ForecastTools\Cache\CacheHandlerInterface;
use ForecastTools\Cache\RedisCacheHandler;
use Predis\Client;

class RedisCacheHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Cache handler
     *
     * @var RedisCacheHandler
     */
    private $cacheHandler;

    public function setUp()
    {
        $redisClient = new Client();
        $this->cacheHandler = new RedisCacheHandler($redisClient);
    }

    /**
     * Test that the redis cache handler implements the cache handler interface
     */
    public function testImplementsCacheHandlerInterface()
    {
        $this->assertTrue($this->cacheHandler instanceof CacheHandlerInterface);
    }

    /**
     * Test that the redis cache handler can save data to redis
     */
    public function testCanSaveDataToCache()
    {
        $this->cacheHandler->save('foo', 'bar', 10);
        $this->assertTrue($this->cacheHandler->contains('foo'));
    }

    /**
     * Test that the redis cache handler can fetch data from redis
     */
    public function testCanFetchDataFromCache()
    {
        $this->cacheHandler->save('foo', 'bar', 10);
        $this->assertTrue('bar' === $this->cacheHandler->fetch('foo'));
    }
}