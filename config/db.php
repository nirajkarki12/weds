<?php
require_once('config.php');

class db extends mysqli {
  // single instance of self shared among all instances
  private static $instance = null;

  // db connection config vars
  private $dbHost = MYSQL_HOST;
  private $user = MYSQL_USER;
  private $pass = MYSQL_PASS;
  private $dbName = MYSQL_DB;
  private $hash = PASSWORD_HASH;

  private function __construct() {
    parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
    if (mysqli_connect_error()) {
      exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
  }

  public static function getInstance() {
    if (!self::$instance instanceof self) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  public function __clone() {
    trigger_error('Clone is not allowed.', E_USER_ERROR);
  }

  public function __wakeup() {
    trigger_error('Deserializing is not allowed.', E_USER_ERROR);
  }

  public function escapeString($string){
    return $this->real_escape_string($string);
  }

  public function dbquery($query){
    return $this->query($query);
  }

  public function getResult($query){
    $result = $this->query($query);
    if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      return $row;
    } else return null;
  }

}