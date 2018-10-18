<div class="col-xs-12 col-lg-6 mb-4">
  <div class="card p-3 m-3">
    <div class="card-body p-3">
      <h5 class="card-title">
       <!-- Replace '_' with ' ' (space) -->
        <?= str_replace("_", " " , $single_product["name"]); ?>
      </h5>
      <p class="card-text"> 
        <!-- calulcate_product_price will return a value that is the result
             of any possible sale. It takes the amount times price. Because
             the function returns a value we can echo it directly -->
        <p> <?= $single_product["amount"]; ?>st á <?= calculate_product_price($single_product); ?> kr </p>
      </p>
    </div>
  </div>
</div>