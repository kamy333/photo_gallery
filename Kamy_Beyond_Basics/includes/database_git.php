<?php
//require_once("config.php");


defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_NAME')   ? null : define("DB_NAME", "photo_gallery");
defined('DB_USER')   ? null : define("DB_USER", "");
defined('DB_PASS')   ? null : define("DB_PASS", "");

class MySQLDatabase
{


    private $connection;
    public $last_query;

    function __construct()
    {
        $this->open_connection();
    }

    public function open_connection()
    {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
        }
    }

    public function close_connection()
    {
        if (isset($this->connection)) {
            mysqli_close($this->connection);
        }

    }

    public function query($sql)
    {
        $this->last_query = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

    public function escape_value($string)
    {
        $this->connection;

        $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $escaped_string;
    }

    public function fetch_array($result_set)
    {
        return mysqli_fetch_assoc($result_set);
    }

    public function num_rows($result_set)
    {
        return mysqli_num_rows($result_set);
    }

    public function insert_id()
    {
        return mysqli_insert_id($this->connection);

    }

    public function affected_rows()
    {
        return mysqli_affected_rows($this->connection);
    }

    private function confirm_query($result)
    {
        if (!$result) {
            $output = "<br>Database query failed.<br>" . mysqli_error($this->connection);
            $output .= "<br>last query executed sql: <br>" . $this->last_query;
            die($output);
        }
    }

}
$database= new MySQLDatabase();



?>