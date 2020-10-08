<?php
include("../utils/db_connection.php");
class PersonCrud
{
    private $data;
    private Database $db;
    private $conn;

    function __construct($data)
    {
        $this->data = $data;
        $this->db = new Database();
        $this->db->connect();
        $this->conn = $this->db->getConnection();
    }

    function getAll()
    {
        $condition = "WHERE deleted_at IS NULL";
        if (isset($this->data) && sizeof($this->data) > 0) {
            $clause = [];
            if (isset($this->data["name"])) $clause[] = " (name LIKE '%" . $this->data['name'] . "%' OR last_name LIKE '%" . $this->data['name'] . "%' )";
            if (isset($this->data['deleted']) && $this->data['deleted'])
                $clause[] = " deleted_at IS NOT NULL ";
            else
                $clause[] = " deleted_at IS NULL ";
            if (sizeof($clause)) $condition = "WHERE " . implode(' AND ', $clause);
        }
        $sql = "SELECT * FROM person " . $condition . " ORDER BY name";
        echo ($sql);
        $result = $this->conn->query($sql);
        $body = [];
        if ($result->num_rows > 0) while ($row = $result->fetch_assoc()) $body[] = $row;
        return $body;
    }

    function get($id)
    {
        $deleted = (isset($this->data['deleted']) && $this->data['deleted']) ? "AND deleted_at IS NOT NULL" : "AND deleted_at IS NULL";
        $sql = "SELECT * FROM person WHERE id = $id " . $deleted . " ORDER BY $id ";
        $result = $this->conn->query($sql);
        if ($result)
            return $result->fetch_assoc();
        return null;
    }
}
