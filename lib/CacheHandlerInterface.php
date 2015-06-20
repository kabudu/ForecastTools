<?php

namespace ForecastTools\Cache;

/**
 * CacheHandlerInterface.php
 */

/**
 * ForecastTools
 *
 * This file contains an interface for cache handlers used with this library
 *
 * @package     ForecastTools
 * @author      Kamba Abudu <kabudu@gmail.com>, Shannon Little <slittle@drakecooper.com>, Charlie Gorichanaz <charlie@gorichanaz.com>
 * @license     http://opensource.org/licenses/MIT The MIT License
 * @version     1.1
 * @link        http://github.com/Enchiridion/ForecastTools
 * @example     ../example.php
 */
interface CacheHandlerInterface
{
    /**
     * Does the cache contain data with this key
     *
     * @param $key
     * @return mixed
     */
    public function contains($key);

    /**
     * Fetch some data from the cache with this key
     *
     * @param $key
     * @return mixed
     */
    public function fetch($key);

    /**
     * Save some data to the cache
     *
     * @param $key
     * @param $data
     * @param $timeout
     * @return mixed
     */
    public function save($key, $data, $timeout);
}