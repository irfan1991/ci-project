<?php

$id = isset($category) ? $category->id : "";
$category_name = isset($category) ? $category->category_name : "";
$category_status = isset($category) ? $category->category_status : "";
$v = isset($v) ? "readonly" : "";
$btn = isset($category) ? "Ubah" : "Simpan";
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
                  <input type="hidden" name="id" value="<?php echo $id; ?>">  
                  <div class="form-group">
                      <label for="category_name">Name</label>
                      <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="category_name"
                        placeholder="Enter name" value="<?php echo $category_name?>" <?php echo $v; ?> required>
                      <small id="category_name" class="form-text text-muted">Input category name  properly.</small>
                    </div>

                    <fieldset class="form-group">
                      <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Status</legend>
                        <div class="col-sm-9">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input" value="Active" <?php if($category_status=='Active') echo 'checked'?> checked>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input" value="Inactive" <?php if($category_status=='Inactive') echo 'checked'?>>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                          </div>
                          

                      </div>
                    </fieldset>
                
                    <?php if ($v == "") { ?>
                      <button type="submit" class="btn btn-primary"><?php echo $btn; ?></button>
                    <?php }?>
                    <a href="/product" class="btn btn-primary" >Kembali</a>
                  </form>
                </div>
              </div>
            </div>
        </div>


  
