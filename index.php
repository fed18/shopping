<?php
/**
 * 'head.php' is your basic <header>-stuff
 * 'products.php' is the array of products
 * 'functions.php' is all the helper functions for example for displaying
 *  error messages and formatting part of the cards
 */
include 'includes/head.php';
include 'includes/products.php';
include 'includes/functions.php';

/**
 * If we have been redirected from 'checkout.php' with an error message:
 * '/index.php?errors=email,address' we will have a variable in the $_GET variable
 * so it would look like this:
 * $_POST = [ "errors" => "email,address" ];
 * This is sent to the display_errors which echoes each error code into an
 * bootstrap alert tag. This function is in 'functions.php'
 */
if(isset($_GET["errors"])){
  display_form_errors($_GET["errors"]);
}
?>

<main class="container mt-5">
  <div class="row">
    <?php
    /**
     * Loop through each product to display the name, price
     * and an input for each product. I've extracted this into
     * a separate include file. Because the card on index.php
     * and checkout.php differs a bit I've decided to put them
     * in separate php-files, they are not the same card.
     */
    foreach($products as $single_product): 
      include 'includes/product_card.php';
    endforeach;
    ?>
  </div>
  <div class="row justify-content-center">
    <div class="col-xs-12 col-lg-6">
      <!-- To reduce some noice I've put the whole form
           which submits the checkout in a separate include -->
      <?php include 'includes/checkout_form.php'; ?>
    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>