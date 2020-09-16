<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <h2>Form Product</h2>
    <form action="/product/save" method="post"  enctype="multipart/form-data">
    <label for="product_name">Nama : </label>
    <input type="text" name="product_name" id="product_name" placeholder="Masukkan Nama Produk" />
    <br/>

    <label for="product_price">Harga : </label>
    <input type="number" name="product_price" id="product_price" placeholder="Masukkan Harga Produk" />
    <br />

    <label for="product_stock">Stock : </label>
    <input type="number" name="product_stock" id="product_stock" placeholder="Masukkan Stock Produk" /> 
    <br />

    <label for="photo">Masukkan Photo Produk</label>
    <input type="file" name="photo" id="photo"> 
    <br />

    <label for="product_category">Kategori : </label>
    <select name="product_category" id="product_category" >
        <option value="" selected>Pilih Kategori</option>
        <?php  foreach ($categories as $row) { ?>
        <option value="<?php echo $row["id"] ?>"><?php echo $row["category_name"];  ?></option>
        <?php }?>
    </select>
    <br />

    <label for="description">Deskripsi Produk</label>
    <textarea name="description" id="" cols="30" rows="10"></textarea>
    <br />
    
    <button type="submit">Save</button>
    </form>
</body>
</html>