<?php

namespace TechStore\Classes;

use mysqli;

abstract class Db
{
  protected $conn;
  protected $table;

  public function connect()
  {
    $this->conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  public function selectAll(string $fields = "*"): array
  {
    // $sql    = "SELECT $fields FROM `$this->table` ";
    // $result = $this->conn->query($sql);
    // return $result->fetch_all(1);

    $sql = "SELECT $fields FROM $this->table ";
    $result = mysqli_query($this->conn ,$sql);

    return mysqli_fetch_all($result , MYSQLI_ASSOC);
  }

  public function selectId($id, string $fields = "*")
  {
    // $sql    = "SELECT $fields FROM `$this->table` WHERE `id` = '$id'";
    // $result = $this->conn->query($sql);
    // return $result->fetch_assoc();

    $sql = "SELECT $fields FROM `$this->table` WHERE `id` = $id ";
    $result = mysqli_query($this->conn ,$sql);

    return mysqli_fetch_assoc($result);
  }

  public function selectWhere($conds ,string $fields = "*") : array
  {

      $sql = "SELECT $fields FROM $this->table WHERE $conds ";
      $result = mysqli_query($this->conn ,$sql);

      return mysqli_fetch_all($result , MYSQLI_ASSOC);

  }

  public function getCount(): int
  {
    $sql    = "SELECT COUNT(*) AS cnt FROM `$this->table` ";
    $result = $this->conn->query($sql);
    return $result->fetch_assoc()["cnt"];
  }

  public function insert(string $fields, string $value)
  {
    $sql = "INSERT INTO $this->table ($fields) VALUES ($value)";
    return $this->conn->query($sql);
  }

  public function insertAndGetId(string $fields, string $value)
  {
    $sql = "INSERT INTO $this->table ($fields) VALUES ($value)";
    $this->conn->query($sql);
    return $this->conn->insert_id;
  }

  public function update(string $set, $id): bool
  {
    $sql = "UPDATE `$this->table` SET $set WHERE `id` = $id";
    return $this->conn->query($sql);
  }

  public function delete($id): bool
  {
    $sql = "DELETE FROM $this->table WHERE `id` = '$id'";
    return $this->conn->query($sql);
  }
}
