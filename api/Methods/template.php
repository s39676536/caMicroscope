<?php
require("./base.php");

$templateUrl = $services['template'];

$getTemplate = function () use ($app, $templateUrl){
  $fields['id'] = $app->request->params("id");
  $path = $templateUrl . "/query/retrieveTemplate";
  echo bindaas("GET", $path, $fields);
};

// define routes
$app->get("/", function() use($app){ echo '{"message":"Select a function."}';});
$app->get("/template", $getTemplate);

$app->run();
?>