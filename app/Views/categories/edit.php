<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <h2>Form Edit Category</h2>
    <form action="/category/update" method="post">
    <input type="text" name="category_name" id="category_name" value="<?php echo $category->category_name?>" />
    <input type="hidden" name="id" value="<?php echo $category->id?>">
    <button type="submit">Save</button>
    </form>
</body>
</html>