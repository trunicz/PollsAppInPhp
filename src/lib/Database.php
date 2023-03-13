<?php

namespace Trnx\Polls\lib;

use PDO;
use PDOException;

class Database
{
  private string $host;
  private string $dbname;
  private string $user;
  private string $password;
  private string $charset;

  public function __construct()
  {
    $this->host = "localhost";
    $this->dbname = "encuestas";
    $this->user = "root";
    $this->password = "root";
    $this->charset = "utf8";
  }

  public function connect(): PDO
  {
    try {
      $connection = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
      ];
      return new PDO($connection, $this->user, $this->password, $options);
    } catch (PDOException $th) {
      print_r('Error connection: ' . $th->getMessage());
    }
  }
}
