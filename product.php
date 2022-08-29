<?php require_once("inc/header.php"); ?>

<?php

use TechStore\Classes\Models\Product;

$productObject = new Product();

if ($request->getHas('id')) {
	$id = $request->get('id');
} else {
	$id = 1;
}

$product = $productObject->selectId($id, "products.id AS prodID, products.name AS prodName, price, img, `desc`, cats.id AS catsID, cats.name AS catsName");

?>


<!-- Single Product -->
<?php if (!empty($product)) : ?>
	<div class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
				<!-- <div class="col-lg-2 order-lg-1 order-2">
						<ul class="image_list">
							<li data-image="images/single_4.jpg"><img src="<?= URL ?>assets/images/single_4.jpg" alt=""></li>
							<li data-image="images/single_2.jpg"><img src="<?= URL ?>assets/images/single_2.jpg" alt=""></li>
							<li data-image="images/single_3.jpg"><img src="<?= URL ?>assets/images/single_3.jpg" alt=""></li>
						</ul>
					</div> -->

				<!-- Selected Image -->
				<div class="col-lg-6 order-lg-2 order-1">
					<div class="image_selected"><img src="<?= URL . "upload/" . $product['img'] ?>" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-6 order-3">
					<div class="product_description">
						<div class="product_category"><?= $product['catsName'] ?></div>
						<div class="product_name"><?= $product['prodName'] ?></div>
						<div class="product_text">
							<p><?= $product['desc'] ?></p>
						</div>
						<div class="order_info d-flex flex-row">
							<form action="<?= URL ?>handlers/add-cart.php" method="POST">

								<input type="hidden" name="id" value="<?= $product['prodID'] ?>">
								<input type="hidden" name="name" value="<?= $product['prodName'] ?>">
								<input type="hidden" name="img" value="<?= $product['img'] ?>">
								<input type="hidden" name="price" value="<?= $product['price'] ?>">
								<div class="clearfix" style="z-index: 1000;">

									<!-- Product Quantity -->
									<div class="product_quantity clearfix">
										<span>Quantity: </span>


										<input id="quantity_input" type="text" name="pty" pattern="[0-9]*" value="1">
										<div class="quantity_buttons">
											<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>
									<div class="product_price"><?= $product['price'] ?></div>
								</div>

								<?php if($cartObject->has($product['prodID']) == false) :?>
								<div class="button_container">
									<button type="submit" name="submit" class="button cart_button">Add to Cart</button>
								</div>
								<?php endif; ?>

							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php else : ?>
	<div class="single_product text-center " style="font-size: 50px;">Product Not Found</div>
<?php endif ?>

<?php require_once("inc/footer.php"); ?>