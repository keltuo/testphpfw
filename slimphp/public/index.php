<?php
use Slim\Factory\AppFactory;
use \App\Processes\ReadFileProcess as ReadFile;
use \App\Helpers\MemoryCheck;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/{row_number}', function ($request, $response, $args) {
	$row_number = $args['row_number'];
	$process = new ReadFile('../storage/data.csv');
	$result = $process->readSplObject($row_number);
	$response->getBody()->write(json_encode(['memory'=> (string) new MemoryCheck(),'file'=>$result]));
	return $response->withHeader('content-type', 'application/json');
});

$app->get('/yield/{row_number}', function ($request, $response, $args) {
	$row_number = $args['row_number'];
	$process = new ReadFile('../storage/data.csv');
	$result = $process->readYieldFile($row_number);
	$response->getBody()->write(json_encode(['memory'=> (string) new MemoryCheck(),'file'=>$result]));
	return $response->withHeader('content-type', 'application/json');
});
$app->get('/fof/{row_number}', function ($request, $response, $args) {
	$row_number = $args['row_number'];
	$process = new ReadFile('../storage/data.csv');
	$result = $process->readFOFile($row_number);
	$response->getBody()->write(json_encode(['memory'=> (string) new MemoryCheck(),'file'=>$result]));
	return $response->withHeader('content-type', 'application/json');
});
$app->get('/spl/{row_number}', function ($request, $response, $args) {
	$row_number = $args['row_number'];
	$process = new ReadFile('../storage/data.csv');
	$result = $process->readSplObject($row_number);
	$response->getBody()->write(json_encode(['memory'=> (string) new MemoryCheck(),'file'=>$result]));
	return $response->withHeader('content-type', 'application/json');
});
$app->get('/spl-array/{row_number}', function ($request, $response, $args) {
	$row_number = $args['row_number'];
	$process = new ReadFile('../storage/data.csv');
	$result = $process->readSplObjectAsArray($row_number);
	$response->getBody()->write(json_encode(['memory'=> (string) new MemoryCheck(),'file'=>$result]));
	return $response->withHeader('content-type', 'application/json');
});
$app->get('/sed/{row_number}', function ($request, $response, $args) {
	$row_number = $args['row_number'];
	$process = new ReadFile('../storage/temp/data.csv');
	$result = $process->readSed($row_number);
	$response->getBody()->write(json_encode(['memory'=> (string) new MemoryCheck(),'file'=>$result]));
	return $response->withHeader('content-type', 'application/json');
});

$app->run();
