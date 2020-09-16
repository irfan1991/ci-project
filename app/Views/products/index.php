<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan</title>
</head>
<body>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        foreach ($products as $row) { ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td> <img src="<?php echo base_url('uploads/'.$row['photo']) ?>" alt="photo product" width="50px" height="50px"> </td>
                <td><?php echo $row['product_name']?></td>
                <td><?php echo $row['product_price']?></td>
                <td><?php echo $row['product_stock']?></td>
                <td><?php echo $row['category_name']?></td>
                <td><?php echo $row['description']?></td>
                <td><a href="/product/edit/<?php echo $row['product_id'] ?>">Edit</a>
                |
                <a href="/product/view/<?php echo $row['product_id'] ?>">View</a>
                |
                <a href="/product/delete/<?php echo $row['product_id']?>">Delete</a>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
<br>
<a href="/product/add">Add Product</a>
    
</body>
</html>