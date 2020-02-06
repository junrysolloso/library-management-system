<?php
  //Define all variable for connection purposes
  define("user", "root");
  define("pass", "");
  define("host", "localhost");
  define("db", "libsystem");
  // class for connecting to database
  class connection
  {
    private $host = host;
    private $user = user;
    private $pass = pass;
    private $db = db;
    public $conn;
    public $error = "Unable to connect to any database.";
    // method for connecting to database
    public function connect()
    {
      $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
      if (!$this->conn) {
        return $this->error;
      } else {
        return $this->conn;
      }
    }
  }
  $connection = new connection();
  $conn = $connection->connect();
?>
