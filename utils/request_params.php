<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");

$request = [
    "method" => $_SERVER["REQUEST_METHOD"],
    "uri" => array_values(array_filter(explode("/", $_SERVER['REQUEST_URI']), function ($s) {
        return $s != "";
    })),
    "data" => putData()
];

function putData()
{
    $putfp = fopen('php://input', 'r');
    $putdata = '';
    while ($data = fread($putfp, 1024))
        $putdata .= $data;
    fclose($putfp);
    return json_decode($putdata, true);
}
