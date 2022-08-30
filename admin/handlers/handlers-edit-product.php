<?php
ob_start();

require_once ("../../app.php");

use TechStore\Classes\Models\Product;
use TechStore\Classes\File;
use TechStore\Classes\Validation\Validator;

if ($request->postHas('submit')) {

  $id         = $request->post('id');
  $name       = $request->post('name');
  $cat_id     = $request->post('cat_id');
  $price      = $request->post('price');
  $pieces     = $request->post('pieces_no');
  $desc       = $request->post('desc');
  $img        = $request->files('img');

  // validation
  $validator = new Validator();
  $validator->validate("name", $name, ["Required", "Str", "Max"]);
  $validator->validate("cat_id", $cat_id, ["Required", "Numeric"]);
  $validator->validate("price", $price, ["Required", "Numeric"]);
  $validator->validate("pieces Number", $pieces, ["Required", "Numeric"]);
  $validator->validate("Description", $desc, ["Required", "Str"]);

  if ($img['error'] == 0) {
    $validator->validate("Image", $img, ["Image"]);
  }

  if ($validator->hasErrors()) {
    $session->set("errors", $validator->getErrors());
    $request->aredirect("add-product.php");
    
  } else {

    $product = new Product;

    $imgName = $product->selectId($id, 'img')['img'];

    if ($img['error'] == 0) {
        unlink(PATH . "upload/$imgName");
        $file = new File($img);
        $imgName = $file->rename()->upload();  
    }

    $product->update("name = '$name', `desc` = '$desc', price = '$price', pieces_no = '$pieces', cat_id = '$cat_id', img = '$imgName'", $id);

    $session->set("success", "Product updated SuccessFully");
    $request->aredirect("products.php");
  }
} else {
  $request->aredirect("edit-product.php");
}

ob_end_flush();
