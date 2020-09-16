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
            <th>Category Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        foreach ($categories as $row) { ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['category_name']?></td>
                <td><a href="/category/edit/<?php echo $row['id'] ?>">Edit</a>
                |
                <a href="/category/view/<?php echo $row['id'] ?>">View</a>
                |
                <a href="/category/delete/<?php echo $row['id']?>">Delete</a>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
<br>
<a href="/category/add">Add category</a>
    
    <script>
        <?php  if (session()->getFlashData('error')) { ?>
            alert('<?php echo session()->getFlashData('error'); ?>')
        <?php } ?>
    </script>
</body>
</html>