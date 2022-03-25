<?php
defined('BASEPATH') or exit('No direct script access allowed');
$active_group = 'server';
$query_builder = TRUE;
// Production Connection
$db['server'] = array(
    'dsn' => '',
    'hostname' => '127.0.0.1:3308',
    'username' => 'root',
	'password' => 'root',
	'database' => 'heartbeat',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);