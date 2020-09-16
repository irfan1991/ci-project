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
    <table>
        <tr>
            <img src="<?php echo base_url()."/uploads/".$product->photo; ?>" alt="">
        </tr>
        <tr>
            <td>Nama Produk</td>
            <td>:</td>
            <td><?php echo $product->product_name; ?></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td><?php echo $product->product_price; ?></td>
        </tr>
        <tr>
            <td>Stock</td>
            <td>:</td>
            <td><?php echo $product->product_stock; ?></td>
        </tr>
        <tr>
            <td>Kategori Produk</td>
            <td>:</td>
            <td><?php echo $product->category_name; ?></td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td><?php echo $product->description; ?></td>
        </tr>
    </table>
   <a href="/product">Kembali</a>
    </form>
</body>
</html>