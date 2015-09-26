<?php

function v($v, $czyscHtmlIExit = false) {
    if ($czyscHtmlIExit)
        ob_end_clean();
    echo '<pre>' . print_r($v, true) . '</pre>';
    if ($czyscHtmlIExit)
        exit;
}
function vv($v, $czyscHtmlIExit = false) {
    if ($czyscHtmlIExit)
        ob_end_clean();
    echo '<pre>';
    var_dump($v);
    echo '</pre>';
    if ($czyscHtmlIExit)
        exit;
}
function vvv($var, & $result = null, $is_view = true) {
    if (is_array($var) || is_object($var))
        foreach ($var as $key => $value)
            vvv($value, $result[$key], false);
    else
        $result = $var;

    if ($is_view)
        v($result);
}
function d($limit = 0) {
    ob_start();
    debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $limit);
    $debug = ob_get_contents();
    ob_end_clean();
    v($debug);
    exit;
}


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#checking-symfony-application-configuration-and-setup
// for more information
//umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1')) || php_sapi_name() === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
