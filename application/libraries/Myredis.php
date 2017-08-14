<?php
/**
 * Created by PhpStorm.
 * User: akader
 * Date: 14/8/17
 * Time: 8:13 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use Predis\Client;

class Myredis {

    private $instance;
    private $config;

    public function __construct($config = array())
    {
        $this->config = $config;
        $this->instance = new Client([
            'host' => $this->config['redis_host'],
            'scheme' => $this->config['redis_scheme'],
            'port' => $this->config['redis_port']
        ]);
    }

    public function get_instance()
    {
        return $this->instance;
    }

}