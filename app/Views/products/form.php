<?php

$id = isset($product) ? $product->product_id : "";
$product_name = isset($product) ? $product->product_name : "";
$product_price = isset($product) ? $product->product_price : "";
$product_stock = isset($product) ? $product->product_stock : "";
$product_category = isset($product) ? $product->category_name : "";
$description = isset($product) ? $product->description : "";
$photo = isset($product) ? $product->photo : "";
$v = isset($v) ? "readonly" : "";
$btn = isset($product) ? "Ubah" : "Simpan";
?>
<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Products</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/hello'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Product</li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $arr; ?></li>
            </ol>
          </div>
       
       <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
                </div>
                <div class="card-body">
                  <form action="<?php echo site_url($urlmethod) ?>" method="post"  enctype="multipart/form-data">
                  <input type="hidden" name="product_id" value="<?php echo $id; ?>">  
                  <div class="form-group">
                      <label for="product_name">Name</label>
                      <input type="text" class="form-control" id="product_name" name="product_name" aria-describedby="product_name"
                        placeholder="Enter name" value="<?php echo $product_name?>" <?php echo $v; ?> required>
                      <small id="product_name" class="form-text text-muted">Input name product properly.</small>
                    </div>
                    <div class="form-group">
                      <label for="product_price">Price</label>
                      <input type="number" class="form-control" name="product_price" id="product_price" aria-describedby="product_price"
                        placeholder="Enter price" value="<?php echo $product_price?>"  <?php echo $v; ?>>
                      <small id="product_price" class="form-text text-muted">Input price properly.</small>
                    </div>
                    <div class="form-group">
                      <label for="product_stock">Stock</label>
                      <input type="number" class="form-control" name="product_stock" id="product_stock" aria-describedby="product_stock"
                        placeholder="Enter stock" value="<?php echo $product_stock?>"  <?php echo $v; ?> required>
                      <small id="Input stock product properly." class="form-text text-muted">Input stock properly.</small>
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" id="" class="form-text text-muted" cols="80" rows="10" <?php echo $v;?>><?php echo $description?></textarea>
                      <small id="Input description product properly." class="form-text text-muted">Input description properly.</small>
                    </div>
                    <div class="form-group">
                    <label for="select2Single">Category</label>
                    <?php if ($v == "") { ?>

                      <select class="select2-single form-control"  name="product_category" id="select2Single"  <?php echo $v; ?> required>
                          <?php if($product_category !== "") { ?>

                            <option value="<?php echo $product->id ?>" selected><?php echo $product->category_name; ?></option>
                            <?php  foreach ($categories as $row) { ?>
                            <option value="<?php echo $row["id"] ?>"><?php echo $row["category_name"];  ?></option>
                            <?php }?>

                          <?php } else { ?>
                            
                            <option value="" selected>Choose Category</option>
                            <?php  foreach ($categories as $row) { ?>
                            <option value="<?php echo $row["id"] ?>"><?php echo $row["category_name"];  ?></option>
                            <?php }?>

                          <?php }?>

                      </select>

                    <?php } else {?>

                      <p><?php echo $product->category_name; ?></p>
                      
                    <?php } ?>
                  </div>
                    <div class="form-group">
                      <div class="custom-file">

                      <?php if ($v == "") { ?>
                        <label class="custom-file-label" for="customFile" id="setFile">Choose file For Product</label>
                        <input type="file" class="custom-file-input" id="customFile" name="photo" onchange="ValidateSingleInput(this);" >
                        
                        <p >Types are allowed :jpg/png/jpeg/PNG</p><br />
                        <?php }?>

                        <?php if ($photo !== "") { ?>
                          <img class="mb-3" src="<?php echo base_url()."/uploads/".$product->photo; ?>" alt=""style="max-height: 200px;" ><br><br>
                        <?php } ?>
                        
                     </div>
                    </div> 
                    <?php if ($v == "") { ?>
                      <button type="submit" class="btn btn-primary"><?php echo $btn; ?></button>
                    <?php }?>
                    <a href="/product" class="btn btn-primary" >Kembali</a>
                  </form>
                </div>
              </div>
            </div>
        </div>



   <script>
    var _validFileExtentions = [".PNG",".png",".jpg",".jpeg"];
    function ValidateSingleInput(params) {
      $('#setFile').text(params.value);
        if (params.type == "file") {
            var sFileName = params.value;
            if (sFileName.length > 0) {
              
        console.log(params.value);
                var blnValid = false;
                for (let index = 0; index < _validFileExtentions.length; index++) {
                    const element = _validFileExtentions[index];
                    if (sFileName.substr(sFileName.length - element.length , element.length).toLowerCase() 
                    ==  element.toLowerCase()) 
                    {
                        blnValid = true;
                        break;    
                    }
                }
            } 

            if (!blnValid) {
                alert("Sorry, "+ sFileName + "that's extention is not allowed: "+ 
                _validFileExtentions.join(", "));
                params.value = "";
                return false;
            }
        }

        
    }
    </script>

  