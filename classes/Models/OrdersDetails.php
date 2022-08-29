<?php

namespace TechStore\Classes\Models;

use TechStore\Classes\Db;

class OrdersDetails extends Db
{
  public function __construct()
  {
    $this->table = "order_details";
    $this->connect();
  }

  public function selectAllProduct($orderId)
  {
    $sql    = "SELECT qty, name, price FROM $this->table JOIN products
    ON $this->table.product_id = products.id WHERE order_id = '$orderId' ";
    
     $result = mysqli_query($this->conn ,$sql);

     return mysqli_fetch_all($result , MYSQLI_ASSOC);
  }
  
}
