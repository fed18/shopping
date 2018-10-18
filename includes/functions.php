<?php
/**
 * This is where the most of the grunt work is happening,
 * everything that is being repeted or logic that can be hidden
 * away is located here
 */

 /**
  * Returns a number that can be multiplied with the
  * price of the product
  */
function sales_price(){
  // date('n') returns the day in format 1-7, cast to int (int)
  $day_of_week = (int)date('N');
  // monday === 1
  if($day_of_week === 1){
    return 0.5;
  }
  // wednesday === 3
  if($day_of_week === 3){
    return 1.1;
  }else{
  // every other day
    return 1;
  }
}

/**
 * If the price is above 200 return the reduced price,
 * otherwise we do not have a reduced price so we will
 * just return the same price that we passed in.
 */
function reduce_by_20($price){
  if ($price > 200) {
    return (int)$price - 20;
  } else {
    return (int)$price;
  }
}

/**
 * This function gets called inside of the checkout-card file, it takes in
 * a product as a parameter, that product has a price and an amount from the
 * loop that it is being called in. We then use both the previously created 
 * function above to calculate the final product. sales_price() will be 0,5, 1 or 1,1,
 * reduce_by_20 will be either the original price or the price reduced by 20.
 * the amount is the amount the user has input in the input-field
 */
function calculate_product_price($product){
  return (int)$product["amount"] * reduce_by_20($product["price"]) * sales_price();
}

/**
 * Empty checks if the variable is longer that empty string: ''
 * if this is the case, the user has not sent anything in the 
 * input field
 */
function check_errors($post){
  // Create an empty array that will hold possible errors, empty means no errors
  $errors = [];
  if(empty($post["email"])){
    /** 
     * if the email is missing in $_POST, push the value "email" to the array
     * and do the same with all errors that can occur
     * */
    array_push($errors, "email");
  }
  if(empty($post["address"])){
    array_push($errors, "address");
  }
  if(empty($post["phone"])){
    array_push($errors, "phone");
  }
  /**
   * Return the array of errors which can have multiple outcomes:
   * [], ["email"], ["email", "address"], ["email", "address", "phone"]
   * */
  return $errors;
}

/**
 * $get_errors is the same as $_GET["errors"].
 * explode does the opposite of implode, it takes a string
 * and turns it into an array:
 * "email, phone" ----> ["email", "phone"]
 * We then loop through this array that has been exploded
 * and echo out an alert item for each. ucfirst stands for
 * uppercasefirst which means capitalize word
 */
function display_form_errors($get_errors){
  $errors = explode(',', $get_errors);
  foreach($errors as $error){
    echo "<p class='alert alert-danger'>Du glömde fylla i " . ucfirst($error) . "</p>";
  }
}

/**
 * This function will looo through both the products array and the $_POST
 * array and compare. If the current item that is being looped has a name
 * that also exists inside of the $_POST array then put that amount into
 * the products array from the $_POST array. This is maybe a overcomplicated
 * way of doing it but it nicely formatted :) 
 */
function add_amount_to_products($products, $post_values){
  foreach($products as $product_key => $product_values){
    /* 
     * To do the comparison we need the key and value from each
     * item in the $_POST-variable. In an indexed array the key is 0,1,2,3 etc
     * and in an associative array the key is for example "price" or "name" or "color"
     * and the value is the value associated with that key. In this case i call that
     * the product */
    foreach($post_values as $post_name => $amount){
      /**
       * if the current looped item name from $_POST is the same as the current looped item
       * from the products-array we have a match. The posted item is the same as the current
       * item in the array. This means that there must be a product in the $products array
       * for example that has a name of "Fidget_Spinner" and we must also have a 
       * key in the $_POST array that also has a name of "Fidget_Spinner"
       */
      if($post_name === $product_values["name"]){
        /** 
         * We now have the position of the item inte the products array '$key'
         * we can create a new key in the array and put the amount inside that.
         * This will create a new key with the name "amount" so we will have:
         * $product["amount"] in the array. The value of that key will be the amount
         * that the user submitted, for example '3' */
        $products[$product_key]["amount"] = (int)$amount;
      }
    }
  }
  return $products;
}

function calculate_total_sum_of_products($products){
  $total_sum = 0;
  foreach($products as $product){
    if($product["amount"]){
      $total_sum += calculate_product_price($product);
    }
  }
  return $total_sum;
}