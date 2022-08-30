<?php
ob_start();

require_once ("../../app.php");

use TechStore\Classes\Validation\Validator;
use TechStore\Classes\Models\Admin;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name             = $request->post('name');
  $email            = $request->post('email');
  $password         = $request->post('password');
  $confirm_password = $request->post('confirm_password');

  $validator = new Validator();
  // validation
  $validator = new Validator();
  $validator->validate('name', $name, ["Required", "Str", "Max"]);
  $validator->validate("email", $email, ["Required", "Numeric"]);
  
  
}  

ob_end_flush();

// public function insert(string $fields, string $value)
// {
//   $sql = "INSERT INTO $this->table ($fields) VALUES ($value)";
//   return $this->conn->query($sql);
// }

// public function update(string $set, $id): bool
// {
//   $sql = "UPDATE `$this->table` SET $set WHERE `id` = $id";
//   return $this->conn->query($sql);
// }
