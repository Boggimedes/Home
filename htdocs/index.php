<?php

require 'vendor/autoload.php';
require 'vendor/Mobile_Detect/Mobile_Detect.php';

$app = new \Slim\Slim();
$detect = new Mobile_Detect();

$app->get('/', function () use($app,$detect){

if( $detect->isMobile() && !$detect->isTablet() ){
    $app->response->setBody('Hello, Mobile');
} else {
    $app->response->setBody('Hello, NOT Mobile');
}
});

$app->run();