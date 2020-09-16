<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <h2>Product Detail</h2>
    <form >
    <input type="text" name="product_name" id="product_name" value="<?php echo $product->product_name?>" readonly/>
    <input type="number" name="product_price" id="product_price" value="<?php echo $product->product_price?>" readonly/>
    <input type="hidden" name="product_id" value="<?php echo $product->product_id?>" readonly>
   <a href="/product">Kemabali</a>
    </form>
</body>
</html>