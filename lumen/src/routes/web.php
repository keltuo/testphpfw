<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use \App\Processes\ReadFileProcess as ReadFile;
use \App\Helpers\MemoryCheck;

$router->get('/{row_number}', function ($row_number = null) use ($router) {
    $process = new ReadFile(__DIR__ . '/../storage/temp/data.csv');
    $result = $process->readSplObject($row_number);
    return response()->json(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$router->get('/yield/{row_number}', function ($row_number = null) use ($router) {
    $process = new ReadFile(__DIR__ . '/../storage/temp/data.csv');
    $result = $process->readYieldFile($row_number);
    return response()->json(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$router->get('/fof/{row_number}', function ($row_number = null) use ($router) {
    $process = new ReadFile(__DIR__ . '/../storage/temp/data.csv');
    $result = $process->readFOFile($row_number);
    return response()->json(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$router->get('/spl/{row_number}', function ($row_number = null) use ($router) {
    $process = new ReadFile(__DIR__ . '/../storage/temp/data.csv');
    $result = $process->readSplObject($row_number);
    return response()->json(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$router->get('/spl-array/{row_number}', function ($row_number = null) use ($router) {
    $process = new ReadFile(__DIR__ . '/../storage/temp/data.csv');
    $result = $process->readSplObjectAsArray($row_number);
    return response()->json(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
$router->get('/sed/{row_number}', function ($row_number = null) use ($router) {
    $process = new ReadFile(__DIR__ . '/../storage/temp/data.csv');
    $result = $process->readSed($row_number);
    return response()->json(['memory'=> (string) new MemoryCheck(),'file'=>$result]);
});
