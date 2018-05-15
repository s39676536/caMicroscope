<?php
// this is the (simple-api) api server base
// all specalizations should be included
require '../../../authenticate.php';
// this also includes param_get
include_once("../utils/RestRequest.php");

// set up route and cache
require 'Slim/Slim.php';
require 'classes/apc.caching.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$oCache = new CacheAPC();

$app->response->headers->set('Content-Type', 'application/json');
$app->response->headers->set("Access-Control-Allow-Origin", "*");

$services = require 'config.php';

if (empty($_SESSION['api_key'])) {
  die();
  // TODO need more graceful than die
}

// function to redirect to bindaas
function bindaas($verb, $path, $fields, $body = ""){
  $fields['api_key'] = $_SESSION['api_key'];
  $url = $path . "?" . http_build_query($fields, '', "&");
  $getRequest = new RestRequest($url, $verb, $body);
  $getRequest->execute();
  // TODO handle non 200s
  // TODO do we want to json_encode our return?
  return $getRequest->responseBody;
}
 ?>