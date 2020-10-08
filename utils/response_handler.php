<?php
function response($response = 404){
    http_response_code($response["status"]);
    echo(json_encode($response["body"]));
}