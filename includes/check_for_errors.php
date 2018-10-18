<?php
/**
 * This function will turn any empty $_POST-variables
 * into an array of errors. It will look like this:
 * $errors = ["email", "phone", "address"];
 */
$errors = check_errors($_POST);

/**
 * If the length of this array is above 0 that means we have an error,
 * so if we count the array length with 'count()' we will get back 0 or > 0,
 * 0 === false, > 0 === true
 * If any errors, redirect to index.php and fill upp $_GET["errors"] by sending
 * the error-values in the URL. Implode is the same as 'join'. So implode
 * will produce a string from an array that can be sent in the URL:
 * ["email", "phone"] ---> "email,phone" 
 */
if(count($errors)){
  header('Location: index.php?errors=' . implode(',', $errors));
}