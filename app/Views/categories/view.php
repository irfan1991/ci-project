<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <h2>Category Detail</h2>
    <form >
    <input type="text" name="category_name" id="category_name" value="<?php echo $category->category_name?>" readonly/>
    
   <a href="/category">Kemabali</a>
    </form>
</body>
</html>