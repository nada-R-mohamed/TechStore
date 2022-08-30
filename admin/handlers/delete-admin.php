<?php
ob_start();
require_once ("../../app.php");
use TechStore\Classes\Models\Admin;

if ($request->getHas('id')) {

  $id = $request->get('id');

  $admin = new Admin;
  $adminId = $admin->selectId($id);
  $admin->delete($id);


  $session->set("success", "Admin deleted SuccessFlly");
  $request->aredirect("admins.php");
}

ob_end_flush();