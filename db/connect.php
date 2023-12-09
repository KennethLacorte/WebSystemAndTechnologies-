<?php
class Connect {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_burgers";
    public $conn;

    public function __construct() {
        // Use try-catch for better error handling
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

            // Check the connection
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }

            // Set character set to utf8 (or the character set you are using)
            $this->conn->set_charset("utf8");
        } catch (Exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Add a method to close the database connection
    public function closeConnection() {
        if ($this->conn !== null) {
            $this->conn->close();
        }
    }
}

?>
