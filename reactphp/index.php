<?php

use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;
use React\Http\Server;
use \App\Processes\ReadFileProcess as ReadFile;
use \App\Helpers\MemoryCheck;
use \App\JsonResponse;

require __DIR__ . '/vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();


$routes = new RouteCollector(new Std(), new GroupCountBased());

$routes->get('/{row_number}', function (ServerRequestInterface $request, $row_number) {
	$process = new ReadFile(__DIR__ . '/storage/data.csv');
	$result = $process->readSplObject($row_number);
	return JsonResponse::ok(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});

$routes->get('/yield/{row_number}', function (ServerRequestInterface $request, $row_number) {
	$process = new ReadFile(__DIR__ . '/storage/data.csv');
	$result = $process->readYieldFile($row_number);
	return JsonResponse::ok(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$routes->get('/fof/{row_number}', function (ServerRequestInterface $request,string $row_number) {
	$process = new ReadFile(__DIR__ . '/storage/data.csv');
	$result = $process->readFOFile($row_number);
	return JsonResponse::ok(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$routes->get('/spl/{row_number}', function (ServerRequestInterface $request, string $row_number) {
	$process = new ReadFile(__DIR__ . '/storage/data.csv');
	$result = $process->readSplObject($row_number);
	return JsonResponse::ok(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$routes->get('/spl-array/{row_number}', function (ServerRequestInterface $request, string $row_number) {
	$process = new ReadFile(__DIR__ . '/storage/data.csv');
	$result = $process->readSplObjectAsArray($row_number);
	return JsonResponse::ok(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$routes->get('/sed/{row_number}', function (ServerRequestInterface $request, string $row_number) {
	$process = new ReadFile(__DIR__ . '/storage/data.csv');
	$result = $process->readSed($row_number);
	return JsonResponse::ok(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});

$server = new Server(new \App\Router($routes));

$socket = new \React\Socket\Server('0.0.0.0:80', $loop);

$server->listen($socket);

$server->on('error', function (Exception $exception) {
	echo $exception->getMessage() . PHP_EOL;
});

echo 'Listening on ' . str_replace('tcp:', 'http:', $socket->getAddress()) . "\n";

$loop->run();
