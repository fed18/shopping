<form action="checkout.php" method="POST" id="checkout">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="spinner@mcfidget.com" autocorrect="off" autocapitalize="none" required>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" id="address" class="form-control" placeholder="Fidgetroad 12b" required>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="tel" name="phone" id="phone" class="form-control" placeholder="+4672111112" required>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary">
  </div>
</form>