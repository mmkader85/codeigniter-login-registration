<?php
/**
 * Configuration file for Redis Server.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Define the connection protocol for Redis Server.
 */
$config['redis_scheme'] = 'tcp';

/**
 * Define the connection host for Redis Server.
 */
$config['redis_host'] = '127.0.0.1';

/**
 * Define the connection port for Redis Server.
 */
$config['redis_port'] = '6379';