<?php
/**
 * We are also using the helper functions on this page so we need to
 * include them here. One of the helper functions is a function to check
 * for errors and store them as an array, the call to this function is inside
 * of 'check_for_errors.php', this file makes a redirect if necessary. If 
 * no redirect (no info missing) is necessary the page will continue to view
 * the content below
 */
require 'includes/functions.php';
require 'includes/check_for_errors.php';
require 'includes/head.php';
require 'includes/products.php';

/*
 * I made a function which takes each amount in $_POST and stores
 * it in the same array as the rest of the info. This will result in
 * the following structure:
 * $products = [
 *  [
 *    "name"    => "Fidget_Spinner" ,
 *    "price"   => 100,
 *    "color"   => "Invisible"
 *    "amount"  => 3
 *  ]
 * ]
 * So I am enhancing the products array with the new amount that is sent
 * in with the form and saving it to the same variable '$products'
 */
$products = add_amount_to_products($products, $_POST);
/**
 * Now that I've got the price, name and amount of each item I can
 * write a function to sum all these values. This function also calculates
 * if the current day has a sale.
 */
$total_sum_of_products = calculate_total_sum_of_products($products);

?>
<main class="container">
  <div class="row">
  <?php 
  /**
   * Similar to the loop in 'index.php' except that I am also checking
   * if the current product that is being looped has an amount. If I didn't
   * fill in an amount on 'index.php' this if-statement will not be true
   * and a card will not be rendered to the page
   */
  foreach($products as $single_product):
    if($single_product["amount"]):
      include 'includes/checkout_card.php';
    endif;
  endforeach;
  ?>
  </div>
  <div class="row justify-content-center text-center">
    <div class="col-6">
      <h2 class="font-weight-bold">Total: </h2>
      <!-- The sum of all products has already been calculated at the top of the file -->
      <h2><?= $total_sum_of_products; ?> kr</h2> 
    </div>
  </div>
  </main>
</body>
</html>