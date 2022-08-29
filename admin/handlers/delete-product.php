<?php
ob_start();
require_once ("../../app.php");
use TechStore\Classes\Models\Product;

if ($request->getHas('id')) {

  $id = $request->get('id');

  $product = new Product;
  $imgName = $product->selectId($id,"img")['img'];

  unlink(PATH . "upload/$imgName"); 
  $product->delete($id);


  $session->set("success", "Product deleted SuccessFlly");
  $request->aredirect("products.php");
}

ob_end_flush();