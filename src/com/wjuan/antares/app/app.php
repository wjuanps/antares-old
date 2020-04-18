<?php 
	$getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
	echo 'URL: ' . $getUrl;
	$setUrl = (empty($getUrl) ? 'index' : $getUrl);
	$url    = explode('/', $setUrl);

	$url[1] = (empty($url[1]) ? null : $url[1]);