<?php

namespace ForecastTools\Cache;

/**
 * RedisCacheHandler.php
 */
use Predis\ClientInterface;

/**
 * ForecastTools
 *
 * This file contains a Redis cache handler implementation for use with this library
 *
 * @package     ForecastTools
 * @author      Kamba Abudu <kabudu@gmail.com>, Shannon Little <slittle@drakecooper.com>, Charlie Gorichanaz <charlie@gorichanaz.com>
 * @license     http://opensource.org/licenses/MIT The MIT License
 * @version     1.1
 * @link        http://github.com/Enchiridion/ForecastTools
 * @example     ../example.php
 * @see http://redis.io/
 */

class RedisCacheHandler implements CacheHandlerInterface
{
    /**
     * Redis client
     *
     * @var \Predis\ClientInterface
     */
    private $redisClient;

    /**
     * Constructor
     *
     * @param \Predis\ClientInterface $redisClient
     */
    public function __construct(ClientInterface $redisClient)
    {
        $this->redisClient = $redisClient;
    }

    /**
     * Does the cache contain data with this key
     *
     * @param $key
     * @return mixed
     */
    public function contains($key)
    {
        return (bool)($this->redisClient->exists($key));
    }

    /**
     * Fetch some data from the cache with this key
     *
     * @param $key
     * @return string
     */
    public function fetch($key)
    {
        return $this->redisClient->get($key);
    }

    /**
     * Save some data to the cache
     *
     * @param $key
     * @param $data
     * @param $timeout
     * @return mixed
     */
    public function save($key, $data, $timeout)
    {
        return $this->redisClient->set($key, $data, 'ex', $timeout);
    }

}