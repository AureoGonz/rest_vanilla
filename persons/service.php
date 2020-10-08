<?php
include('crud.php');
class PersonService
{
    private $path;
    private $data;
    private PersonCrud $crud;

    function __construct($path, $data)
    {
        $this->path = $path;
        $this->data = $data;
        $this->crud = new PersonCrud($this->data);
    }

    function get()
    {
        switch (sizeof($this->path)) {
            case 1:
                $body = $this->crud->getAll();
                if(sizeof($body)==0)
                    return ["status" => 204, "body" => $body];
                return ["status" => 200, "body" => $body];
            case 2:
                $body = $this->crud->get($this->path[1]);
                if(!isset($body))
                    return ["status" => 404, "body" => ["message"=>"Person with id = ".$this->path[1]." not found"]];    
                return ["status" => 200, "body" => $body];
            default:
                return ["status" => 400, "body" => "Bad Request"];
        }
    }

    function create()
    {
        if (!isset($this->data) || sizeof($this->data) == 0)
            return ["status" => 400, "body" => "Bad Request"];
        return ["status" => 201, "body" => "create"];
    }

    function update()
    {
        if (sizeof($this->path) != 2)
            return ["status" => 400, "body" => "Bad Request"];
        if (!isset($this->data) || sizeof($this->data) == 0)
            return ["status" => 406, "body" => "Not Acceptable"];
        return ["status" => 202, "body" => "update"];
    }

    function delete()
    {
        if (sizeof($this->path) != 2)
            return ["status" => 400, "body" => "Bad Request"];
        return ["status" => 202, "body" => "delete"];
    }
}
