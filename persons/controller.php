<?php
include("../utils/request_params.php");
include("../utils/response_handler.php");
include("service.php");

$service = new PersonService($request["uri"],$request["data"]);

switch ($request["method"]) {
    case "GET":
        response($service->get());
    break;
    case "POST":
        response($service->create());
    break;
    case "PUT":
        response($service->update());
    break;
    case "DELETE":
        response($service->delete());
    break;
    default:
    http_response_code(405);
    echo(json_encode(["message"=>"Invalid Method"]));
    break;
}

// GET     persons / id        body
// DELETE  persons / id
// GET     persons /           body
// POST    persons /           body
// PUT     persons / id        body