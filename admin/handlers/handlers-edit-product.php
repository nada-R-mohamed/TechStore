<?php
ob_start();

require_once "../../app.php";

use TechStore\Classes\Models\Product;
use TechStore\Classes\File;
use TechStore\Classes\Validation\Validator;

if ($request->getHas('submit')) {

  $id         = $request->post('id');
  $name       = $request->post('name');
  $category   = $request->post('category');
  $price      = $request->post('price');
  $pieces     = $request->post('pieces');
  $desc       = $request->post('desc');
  $img        = $request->files('img');

  // validation
  $validator = new Validator();
  $validator->validate("name", $name, ["Required", "Str", "Max"]);
  $validator->validate("category", $category, ["Required", "Numeric"]);
  $validator->validate("price", $price, ["Required", "Numeric"]);
  $validator->validate("pieces Number", $pieces, ["Required", "Numeric"]);
  $validator->validate("Description", $desc, ["Required", "Str"]);

  if ($img['error'] == 0) {
    $validator->validate("Image", $img, ["Image"]);
  }

  if ($validator->hasErrors()) {
    $session->set("errors", $validator->getErrors());
    $request->aredirect("edit-product.php");
    
  } else {

    $product = new Product;

    $imgName = $product->selectId($id, 'img')['img'];

    if ($img['error'] == 0) {
        unlink(PATH . "upload/$imgName");
        $file = new File($img);
        $imgName = $file->rename()->upload();  
    }

    $product->update("name = '$name', `desc` = '$desc', price = '$price', piecec_no = '$pieces', cats_id = '$category', img = '$imgName'", $id);

    $session->set("success", "Product Edit SuccessFlly");
    $request->aredirect("products.php");
  }
} else {
  $request->aredirect("edit-product.php");
}

ob_end_flush();
