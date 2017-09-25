<?php
// Routes
require __DIR__.'/../vendor/Mobile_Detect/Mobile_Detect.php';
$detect = new Mobile_Detect();

$app->get('/', function ($request, $response, $args) use($detect){
	if( $detect->isMobile() && !$detect->isTablet() ){
		return $this->renderer->render($response, 'portfolio/dan/dan-mobile-portfolio.php', $args);
	} else {
		return $this->renderer->render($response, 'portfolio/dan/dan-portfolio.php', $args);
	}
    
});
