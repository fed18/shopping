<?php
/**
 * So we don't have to write '$product["name"]' everywhere, easier reference,
 * $product["name"] will have the same value as $name but $name is easier to write
 */

$name = $single_product["name"];

/** 
 * Name in array is 'Fidget_Spinner' but this will replace all '_'
 * with spaces for pretty output to the page because we don't want
 * snakes on a page
 * */
$pretty_name = str_replace("_", " ", $name);
?>
<div class="col-xs-12 col-lg-6 mb-4">
  <div class="card">
    <div class="card-body p-3">
      <h2 class="card-title">
        <!-- Use the pretty name in H2-tag -->
        <?= $pretty_name; ?>
      </h2>
      <p class="card-text">
        <p><strong>Price:</strong> <?= $single_product["price"]; ?></p>
        <div class="form-group">
          <!-- Always good to have a label, in this case I am using the 'sr-only'
              class that will hide the label for eyes but will still be read if
              the screen is read with a screen reader. Use the standard $name
              for everything that can't handle spaces  -->
          <label for="<?= $name; ?>" class="sr-only"><?= $pretty_name; ?></label>
          <!-- form-attribut connects this single input to a specific form with the id
              of 'checkout', this form is located in 'checkout_form.php' -->
          <input type="number" form="checkout" name="<?= $name; ?>" id="<?= $name; ?>" min="0" max="999" class="form-control" placeholder="Amount to order">
        </div>
      </p>
    </div>
  </div>
</div>