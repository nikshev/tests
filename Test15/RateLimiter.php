<?php

/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 4/1/16
 * Time: 10:41 AM
 */
class RateExceededException extends Exception {}
class NotSetCallableFunctionException extends Exception {}

class RateLimiter
{
    private $prefix, $memcache, $limit, $user_func;


    /**
     * @param Memcache $memcache
     * @param string $prefix - prefix for keys
     * @param $limit - function calling limit
     * @param callable $user_func - user function for calling
     */
    public function __construct(Memcache $memcache, $token = "token_by_default", $limit, callable $user_func) {
        $this->memcache = $memcache;
        $this->prefix = $token . uniqid();
        //we can post token to database with some information about user
        //Also we can get some information about user by token
        $this->limit=$limit;
        $this->user_func=$user_func;
        }



    /**
     * Check limit for calling and run if not exceed
     * @throws RateExceededException
     */
    public function Run($try){
        $requests = 0;
        $time=time();
        $key=$this->prefix.$time;
        $requestsInCurrentSeconds = $this->memcache->get($key);

        if (false !== $requestsInCurrentSeconds) { //If key exist
            $requests += $requestsInCurrentSeconds; //we get key value
            $this->memcache->increment($key, 1); //Increment
        }
        else { //if key not exist
            $this->memcache->set($key, 1, 0, 2); //Set key for two seconds
        }

        if ($requests < $this->limit) {
            //call user function
            if (isset($this->user_func)&&is_callable($this->user_func)) {
                return call_user_func($this->user_func,$try);
            }
            else
                throw new NotSetCallableFunctionException;
        }
        else {
            throw new RateExceededException;
        }
    }


}